<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Position_;

class PositionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $position1 = Position_::create([
            'id' => '1',
            'name' => 'CEO (TM2)',
            'status' => 'active',    
        ]);
        $position1->save();
        
        $position2 = Position_::create([
            'id' => '2',
            'name' => 'Director (TM1)',
            'status' => 'active',    
        ]);
        $position2->save();

        $position3 = Position_::create([
            'id' => '3',
            'name' => 'Senior Leadership Team (SLT) (UM1)', 
            'status' => 'active',
        ]);
        $position3->save();

        $position4 = Position_::create([
            'id' => '4',
            'name' => 'Senior Manager (M3)',
            'status' => 'active',
        ]);
        $position4->save();

        $position5 = Position_::create([
            'id' => '5',
            'name' => 'Manager (M2)',
            'status' => 'active',
        ]);
        $position5->save();

        $position6 = Position_::create([
            'id' => '6',
            'name' => 'Assistant Manager (M1)',
            'status' => 'active',
        ]);
        $position6->save();

        $position7 = Position_::create([
            'id' => '7',
            'name' => 'Senior Executive (E3)',
            'status' => 'active',
        ]);
        $position7->save();

        $position8 = Position_::create([
            'id' => '8',
            'name' => 'Executive (E2)',
            'status' => 'active',
        ]);
        $position8->save();

        $position9 = Position_::create([
            'id' => '9',
            'name' => 'Junior Executive (E1)',
            'status' => 'active',
        ]);
        $position9->save();

        $position10 = Position_::create([
            'id' => '10',
            'name' => 'Senior Non-Executive (NE2)',
            'status' => 'active',
        ]);
        $position10->save();

        $position11 = Position_::create([
            'id' => '11',
            'name' => 'Junior Non-Executive (NE1)',
            'status' => 'active',
        ]);
        $position11->save();
    }
}
