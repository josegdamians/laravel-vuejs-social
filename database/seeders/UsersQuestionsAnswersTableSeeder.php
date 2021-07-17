<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create()->each(function($u) {
            $u->questions()
              ->saveMany(
                    Question::factory(rand(1,5))->make()
              )
              ->each(function($q) {
                  $q->answers()
                    ->saveMany(
                        Answer::factory(rand(1,5))->make());
              });
        });
        //User::factory(3)->create();
        //Question::factory(10)->create();
    }
}
