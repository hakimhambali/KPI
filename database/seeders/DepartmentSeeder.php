<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Department_;

class DepartmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $department1 = Department_::create([
            'id' => '1',
            'name' => 'Senior Leadership Team (SLT)',
            'status' => 'active',    
        ]);
        $department1->save();
        
        $department2 = Department_::create([
            'id' => '2',
            'name' => 'CEO Office',    
            'status' => 'active',
        ]);
        $department2->save();

        $department3 = Department_::create([
            'id' => '3',
            'name' => 'Human Resource (HR) & Administration', 
            'status' => 'active',
        ]);
        $department3->save();

        $department4 = Department_::create([
            'id' => '4',
            'name' => 'Account & Finance (A&F)',
            'status' => 'active',
        ]);
        $department4->save();

        $department5 = Department_::create([
            'id' => '5',
            'name' => 'Sales',
            'status' => 'active',
        ]);
        $department5->save();

        $department6 = Department_::create([
            'id' => '6',
            'name' => 'Marketing',
            'status' => 'active',
        ]);
        $department6->save();

        $department7 = Department_::create([
            'id' => '7',
            'name' => 'Operation',
            'status' => 'active',
        ]);
        $department7->save();

        $department8 = Department_::create([
            'id' => '8',
            'name' => 'High Network Client (HNC)',
            'status' => 'active',
        ]);
        $department8->save();

        $department9 = Department_::create([
            'id' => '9',
            'name' => 'Research & Development (R&D)',
            'status' => 'active',
        ]);
        $department9->save();
    }
}
