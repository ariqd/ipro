<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('username', 'admin')->update(['role' => 'admin']);
    }
}
