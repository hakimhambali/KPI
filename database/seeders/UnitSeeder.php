<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Unit_;

class UnitSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $unit1 = Unit_::create([
            'id' => '1',
            'name' => 'Head Department',
            'status' => 'active',    
        ]);
        $unit1->save();
        
        $unit2 = Unit_::create([
            'id' => '2',
            'name' => 'Senior Leadership Team (SLT)',  
            'status' => 'active',   
        ]);
        $unit2->save();

        $unit3 = Unit_::create([
            'id' => '3',
            'name' => 'Personal Assistant',
            'status' => 'active', 
        ]);
        $unit3->save();

        $unit4 = Unit_::create([
            'id' => '4',
            'name' => 'Document Controller',
            'status' => 'active',
        ]);
        $unit4->save();

        $unit5 = Unit_::create([
            'id' => '5',
            'name' => 'Driver & Logistic',
            'status' => 'active',
        ]);
        $unit5->save();

        $unit6 = Unit_::create([
            'id' => '6',
            'name' => 'Payroll and C&B',
            'status' => 'active',
        ]);
        $unit6->save();

        $unit7 = Unit_::create([
            'id' => '7',
            'name' => 'Training & Development',
            'status' => 'active',
        ]);
        $unit7->save();

        $unit8 = Unit_::create([
            'id' => '8',
            'name' => 'Admin Procurement',
            'status' => 'active',
        ]);
        $unit8->save();

        $unit9 = Unit_::create([
            'id' => '9',
            'name' => 'Recruitment',
            'status' => 'active',
        ]);
        $unit9->save();

        $unit10 = Unit_::create([
            'id' => '10',
            'name' => 'Account Receivable',
            'status' => 'active',
        ]);
        $unit10->save();

        $unit11 = Unit_::create([
            'id' => '11',
            'name' => 'Account Payable',
            'status' => 'active',
        ]);
        $unit11->save();

        $unit12 = Unit_::create([
            'id' => '12',
            'name' => 'Customer Support & Closing',
            'status' => 'active',
        ]);
        $unit12->save();

        $unit13 = Unit_::create([
            'id' => '13',
            'name' => 'Program',
            'status' => 'active',
        ]);
        $unit13->save();

        $unit14 = Unit_::create([
            'id' => '14',
            'name' => 'Creative Director',
            'status' => 'active',
        ]);
        $unit14->save();

        $unit15 = Unit_::create([
            'id' => '15',
            'name' => 'Media Director',
            'status' => 'active',
        ]);
        $unit15->save();

        $unit16 = Unit_::create([
            'id' => '16',
            'name' => 'Social Media',
            'status' => 'active',
        ]);
        $unit16->save();

        $unit17 = Unit_::create([
            'id' => '17',
            'name' => 'Digital Marketer',
            'status' => 'active',
        ]);
        $unit17->save();

        $unit18 = Unit_::create([
            'id' => '18',
            'name' => 'Admin & Procurement',
            'status' => 'active',
        ]);
        $unit18->save();

        $unit19 = Unit_::create([
            'id' => '19',
            'name' => 'Backstage',
            'status' => 'active',
        ]);
        $unit19->save();

        $unit20 = Unit_::create([
            'id' => '20',
            'name' => 'Inventory & Logistic',
            'status' => 'active',
        ]);
        $unit20->save();

        $unit21 = Unit_::create([
            'id' => '21',
            'name' => 'General Worker',
            'status' => 'active',
        ]);
        $unit21->save();

        $unit22 = Unit_::create([
            'id' => '22',
            'name' => 'Platinum',
            'status' => 'active',
        ]);
        $unit22->save();

        $unit23 = Unit_::create([
            'id' => '23',
            'name' => 'Ultimate',
            'status' => 'active',
        ]);
        $unit23->save();

        $unit24 = Unit_::create([
            'id' => '24',
            'name' => 'Graphic',
            'status' => 'active',
        ]);
        $unit24->save();

        $unit25 = Unit_::create([
            'id' => '25',
            'name' => 'Web Designer',
            'status' => 'active',
        ]);
        $unit25->save();

        $unit26 = Unit_::create([
            'id' => '26',
            'name' => 'Web Developer',
            'status' => 'active',
        ]);
        $unit26->save();

        $unit27 = Unit_::create([
            'id' => '27',
            'name' => 'Data Analytic',
            'status' => 'active',
        ]);
        $unit27->save();
    }
}
