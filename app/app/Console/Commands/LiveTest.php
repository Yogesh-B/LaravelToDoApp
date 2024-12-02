<?php

namespace App\Console\Commands;

use App\Models\Acl;
use App\Models\Note;
use App\Models\RecordList;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LiveTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'livetest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'testing somethings in live, while development';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $u1 = User::create([
        //     'name' => 'test1',
        //     'email' => 'test1@test.com',
        //     'password' => '123456',
        // ]);

        // $u2 = User::create([
        //     'name' => 'bapu',
        //     'email' => 'bapu@test.com',
        //     'password' => '123456',
        // ]);


        // $u1 = User::find(1);
        // $u2 = User::find(2);
        


        // $rl1 = RecordList::create([
        //     'owner_id' => $u1->id,
        //     'list_name' => 'Subji List',
        // ]);

        // $rl2 = RecordList::create([
        //     'owner_id' => $u2->id,
        //     'list_name' => 'Shopping List',
        // ]);



        // $n1 = Note::create([
        //     'owner_id' => $u1->id,
        //     'title'=> "#21/11/2024",
        //     'record_list_id' => $rl1->id,
        //     'description' => <<<EOT
        //     - tomato - 1 kg
        //     - potato - 1 kg
        //     EOT,
        //     'is_completed' => false,
        // ]);

        // $n2 = Note::create([
        //     'owner_id' => $u1->id,
        //     'title'=> "#22/11/2024",
        //     'record_list_id' => $rl1->id,
        //     'description' => <<<EOT
        //     - potato - 1 kg
        //     - bengan - 1 kg
        //     - chilli - 100 gm
        //     EOT,
        //     'is_completed' => false,
        // ]);

        // $n3 = Note::create([
        //     'owner_id' => $u2->id,
        //     'title'=> "households",
        //     'record_list_id' => $rl2->id,
        //     'description' => <<<EOT
        //     - Washing powder - 1 kg
        //     - Handwash - 1 piece
        //     EOT,
        //     'is_completed' => false,
        // ]);

        // $n4 = Note::create([
        //     'owner_id' => $u2->id,
        //     'title'=> "stationery",
        //     'record_list_id' => $rl2->id,
        //     'description' => <<<EOT
        //     - eraser - 1 piece
        //     - pen - 2 piece
        //     - pencil - 1 piece
        //     EOT,
        //     'is_completed' => false,
        // ]);



        // 'user_id',
        // 'entity_type',
        // 'entity_id',
        // 'permission',


        //set observer to make this automatic
        // Acl::create([
        //     'user_id' => 1,
        //     'entity_type' => 'list',
        //     'entity_id' => 1,
        //     'permission'=>'owner',    
        // ]);
        // Acl::create([
        //     'user_id' => 1,
        //     'entity_type' => 'note',
        //     'entity_id' => 1,
        //     'permission'=>'owner',    
        // ]);Acl::create([
        //     'user_id' => 1,
        //     'entity_type' => 'note',
        //     'entity_id' => 2,
        //     'permission'=>'owner',    
        // ]);


        // Acl::create([
        //     'user_id' => 1,
        //     'entity_type' => 'list',
        //     'entity_id' => 1,
        //     'permission'=>'owner',    
        // ]);
        // Acl::create([
        //     'user_id' => 1,
        //     'entity_type' => 'note',
        //     'entity_id' => 1,
        //     'permission'=>'owner',    
        // ]);
        Acl::create([
            'user_id' => 1,
            'entity_type' => 'list',
            'entity_id' => 30,
            'permission'=>'viewer',    
        ]);



        $this->info("done");
    }
}
