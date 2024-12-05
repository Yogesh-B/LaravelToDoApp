<?php

namespace Database\Factories;

use App\Models\RecordList;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'record_list_id'=> RecordList::factory()->create()->id,
            'title'=> fake()->sentence(3),
            'description'=> fake()->text(100),
            'is_completed'=> fake()->randomElement([true,false]),
        ];
    }
}
