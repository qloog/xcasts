<?php

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->delete();

        for ($i=0; $i<30; $i++) {
            $data = [];
            $data['course_id'] = 1;
            $data['name'] = Faker\Provider\zh_CN\Person::titleFemale();
            $data['url'] = 'baidu.com';
            $data['is_free'] = 1;
            $data['length'] = rand(10, 1000);

            \App\Models\Video::create($data);
        }
    }
}
