<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Role_;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $role1 = Role_::create([
            'id' => '1',
            'name' => 'admin',
            'desc' => 'Control all data',
            'status' => 'active',    
        ]);
        $role1->save();
        
        $role2 = Role_::create([
            'id' => '2',
            'name' => 'moderator',
            'desc' => 'Control User Management & Settings',
            'status' => 'active',    
        ]);
        $role2->save();

        $role3 = Role_::create([
            'id' => '3',
            'name' => 'hr',
            'desc' => 'Act as Human Resource & control data needed',
            'status' => 'active', 
        ]);
        $role3->save();

        $role4 = Role_::create([
            'id' => '4',
            'name' => 'manager',
            'desc' => 'Act as Manager of the employees & monitor all their data',
            'status' => 'active',
        ]);
        $role4->save();

        $role5 = Role_::create([
            'id' => '5',
            'name' => 'dc',
            'desc' => 'Act as Document Controller & provide SOP',
            'status' => 'active',
        ]);
        $role5->save();

        $role6 = Role_::create([
            'id' => '6',
            'name' => 'pro',
            'desc' => "Act as Admin Procurement & monitor all the employee's complaint",
            'status' => 'Active',
        ]);
        $role6->save();

        $role7 = Role_::create([
            'id' => '7',
            'name' => 'employee',
            'desc' => 'Staff of the company',
            'status' => 'active',
        ]);
        $role7->save();
    }
}
