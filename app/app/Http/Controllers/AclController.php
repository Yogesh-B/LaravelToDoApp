<?php

namespace App\Http\Controllers;

use App\Http\Resources\AclCollection;
use App\Http\Resources\FailureResponse;
use App\Http\Resources\SuccessResponse;
use App\Models\Acl;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AclController extends Controller
{
    public function show(Request $request)
    {
        $validated = $request->validate([
            'entity_type' => 'required',
            'entity_id' => 'required',
        ]);

        $perPage = $request->input('per_page', 15);

        // Check ownership using Gate
        if (Gate::denies('grant-permission', [$validated['entity_type'], $validated['entity_id']])) {
            return new FailureResponse(["Only owner can access this resource!"], 'Unauthorized', Response::HTTP_FORBIDDEN);
        }

        $acls = Acl::where('entity_type', $validated['entity_type'])
            ->where('entity_id', $validated['entity_id'])
            ->paginate($perPage);

        return new SuccessResponse(new AclCollection($acls), 'Acl fetched successfully', Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'entity_type' => 'required',
            'entity_id' => 'required',
            'user_id' => 'required',
            'permission' => 'required|in:viewer,editor,owner',
        ]);

        // Check ownership using Gate
        if (Gate::denies('grant-permission', [$validated['entity_type'], $validated['entity_id']])) {
            return new FailureResponse(["Only owner can grant permission!"], 'Unauthorized', Response::HTTP_FORBIDDEN);
        }

        $acl = Acl::create($validated);

        return new SuccessResponse($acl, 'Permission granted successfully', Response::HTTP_CREATED);
    }

    public function update(Request $request, Acl $acl)
    {
        $validated = $request->validate([
            'entity_type' => 'required',
            'entity_id' => 'required',
            'user_id' => 'required',
            'permission' => 'required|in:viewer,editor,owner',
        ]);

        // Check ownership using Gate
        if (Gate::denies('grant-permission', [$validated['entity_type'], $validated['entity_id']])) {
            return new FailureResponse(["Only owner can update permission!"], 'Unauthorized', Response::HTTP_FORBIDDEN);
        }

        $acl->update($validated);

        return new SuccessResponse($acl, 'Permission updated successfully', Response::HTTP_CREATED);
    }

    public function destroy(Request $request, Acl $acl)
    {
        // Check ownership using Gate
        if (Gate::denies('grant-permission', [$acl->entity_type, $acl->entity_id])) {
            return new FailureResponse(["Only owner can delete permission!"], 'Unauthorized', Response::HTTP_FORBIDDEN);
        }

        $acl->delete();
        
        return new SuccessResponse($acl, 'Permission deleted successfully', Response::HTTP_CREATED);
    }
}
