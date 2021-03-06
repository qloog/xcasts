<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        // init super admin
        \App\Models\Admin::create([
            'name'   => 'admin',
            'email' => 'wql2008@vip.qq.com',
            'password' => bcrypt(123456789),
            'created_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
