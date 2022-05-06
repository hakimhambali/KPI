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
            'status' => 'active',    
        ]);
        $role1->save();
        
        $role2 = Role_::create([
            'id' => '2',
            'name' => 'moderator',
            'status' => 'active',    
        ]);
        $role2->save();

        $role3 = Role_::create([
            'id' => '3',
            'name' => 'hr',
            'status' => 'active', 
        ]);
        $role3->save();

        $role4 = Role_::create([
            'id' => '4',
            'name' => 'manager',
            'status' => 'active',
        ]);
        $role4->save();

        $role5 = Role_::create([
            'id' => '5',
            'name' => 'dc',
            'status' => 'active',
        ]);
        $role5->save();

        $role6 = Role_::create([
            'id' => '6',
            'name' => 'pro',
            'status' => 'active',
        ]);
        $role6->save();

        $role7 = Role_::create([
            'id' => '7',
            'name' => 'employee',
            'status' => 'active',
        ]);
        $role7->save();
    }
}
