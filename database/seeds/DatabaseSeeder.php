<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$this->call('UsersTableSeeder');
        //$this->call('RolesTableSeeder');
        //$this->call('PermissionsTableSeeder');

        //$this->call('CommentTableSeeder');
        $this->call('AdminsTableSeeder');
    }
}
