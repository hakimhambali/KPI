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
            'status' => '1',    
        ]);
        $role1->save();
        
        $role2 = Role_::create([
            'id' => '2',
            'name' => 'moderator',
            'status' => '1',    
        ]);
        $role2->save();

        $role3 = Role_::create([
            'id' => '3',
            'name' => 'hr',
            'status' => '1', 
        ]);
        $role3->save();

        $role4 = Role_::create([
            'id' => '4',
            'name' => 'manager',
            'status' => '1',
        ]);
        $role4->save();

        $role5 = Role_::create([
            'id' => '5',
            'name' => 'dc',
            'status' => '1',
        ]);
        $role5->save();

        $role6 = Role_::create([
            'id' => '6',
            'name' => 'pro',
            'status' => '1',
        ]);
        $role6->save();

        $role7 = Role_::create([
            'id' => '7',
            'name' => 'employee',
            'status' => '1',
        ]);
        $role7->save();
    }
}
