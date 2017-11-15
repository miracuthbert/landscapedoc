<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Role::class)->create([
            'name' => 'Admin',
            'details' => 'Has all privileges in app.'
        ]);

        factory(\App\Models\Role::class)->create([
            'name' => 'Manager',
            'details' => 'Manages daily business process.'
        ]);

        factory(\App\Models\Role::class, 2)->create();
    }
}
