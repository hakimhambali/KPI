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
            'status' => '1',    
        ]);
        $unit1->save();
        
        $unit2 = Unit_::create([
            'id' => '2',
            'name' => 'Senior Leadership Team (SLT)',  
            'status' => '1',   
        ]);
        $unit2->save();

        $unit3 = Unit_::create([
            'id' => '3',
            'name' => 'Personal Assistant',
            'status' => '1', 
        ]);
        $unit3->save();

        $unit4 = Unit_::create([
            'id' => '4',
            'name' => 'Document Controller',
            'status' => '1',
        ]);
        $unit4->save();

        $unit5 = Unit_::create([
            'id' => '5',
            'name' => 'Driver & Logistic',
            'status' => '1',
        ]);
        $unit5->save();

        $unit6 = Unit_::create([
            'id' => '6',
            'name' => 'Payroll and C&B',
            'status' => '1',
        ]);
        $unit6->save();

        $unit7 = Unit_::create([
            'id' => '7',
            'name' => 'Training & Development',
            'status' => '1',
        ]);
        $unit7->save();

        $unit8 = Unit_::create([
            'id' => '8',
            'name' => 'Admin Procurement',
            'status' => '1',
        ]);
        $unit8->save();

        $unit9 = Unit_::create([
            'id' => '9',
            'name' => 'Recruitment',
            'status' => '1',
        ]);
        $unit9->save();

        $unit10 = Unit_::create([
            'id' => '10',
            'name' => 'Account Receivable',
            'status' => '1',
        ]);
        $unit10->save();

        $unit11 = Unit_::create([
            'id' => '11',
            'name' => 'Account Payable',
            'status' => '1',
        ]);
        $unit11->save();

        $unit12 = Unit_::create([
            'id' => '12',
            'name' => 'Customer Support & Closing',
            'status' => '1',
        ]);
        $unit12->save();

        $unit13 = Unit_::create([
            'id' => '13',
            'name' => 'Program',
            'status' => '1',
        ]);
        $unit13->save();

        $unit14 = Unit_::create([
            'id' => '14',
            'name' => 'Creative Director',
            'status' => '1',
        ]);
        $unit14->save();

        $unit15 = Unit_::create([
            'id' => '15',
            'name' => 'Media Director',
            'status' => '1',
        ]);
        $unit15->save();

        $unit16 = Unit_::create([
            'id' => '16',
            'name' => 'Social Media',
            'status' => '1',
        ]);
        $unit16->save();

        $unit17 = Unit_::create([
            'id' => '17',
            'name' => 'Digital Marketer',
            'status' => '1',
        ]);
        $unit17->save();

        $unit18 = Unit_::create([
            'id' => '18',
            'name' => 'Admin & Procurement',
            'status' => '1',
        ]);
        $unit18->save();

        $unit19 = Unit_::create([
            'id' => '19',
            'name' => 'Backstage',
            'status' => '1',
        ]);
        $unit19->save();

        $unit20 = Unit_::create([
            'id' => '20',
            'name' => 'Inventory & Logistic',
            'status' => '1',
        ]);
        $unit20->save();

        $unit21 = Unit_::create([
            'id' => '21',
            'name' => 'General Worker',
            'status' => '1',
        ]);
        $unit21->save();

        $unit22 = Unit_::create([
            'id' => '22',
            'name' => 'Platinum',
            'status' => '1',
        ]);
        $unit22->save();

        $unit23 = Unit_::create([
            'id' => '23',
            'name' => 'Ultimate',
            'status' => '1',
        ]);
        $unit23->save();

        $unit24 = Unit_::create([
            'id' => '24',
            'name' => 'Graphic',
            'status' => '1',
        ]);
        $unit24->save();

        $unit25 = Unit_::create([
            'id' => '25',
            'name' => 'Web Designer',
            'status' => '1',
        ]);
        $unit25->save();

        $unit26 = Unit_::create([
            'id' => '26',
            'name' => 'Web Developer',
            'status' => '1',
        ]);
        $unit26->save();

        $unit27 = Unit_::create([
            'id' => '27',
            'name' => 'Data Analytic',
            'status' => '1',
        ]);
        $unit27->save();
    }
}
