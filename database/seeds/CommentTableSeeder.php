<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        for ($i=0; $i<30; $i++) {
            $data = [];
            $data['type'] = 'video';
            $data['relation_id'] = 5;
            $data['ip'] = '127.0.0.1';
            $data['content'] = Faker\Provider\zh_CN\Address::country();
            $data['user_id'] = 1;
            $data['up_count'] = rand(10, 1000);
            $data['device_type'] = 'ios';

            \App\Models\Comment::create($data);
        }
    }
}
