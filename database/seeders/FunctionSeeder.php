<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\Function_;

class FunctionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {  
        $function1 = Function_::create([
            'id' => '1',
            'name' => 'Kad Skor Korporat1',
            'status' => 'active',    
        ]);
        $function1->save();
        
        $function2 = Function_::create([
            'id' => '2',
            'name' => 'Kewangan1',  
            'status' => 'active',   
        ]);
        $function2->save();

        $function3 = Function_::create([
            'id' => '3',
            'name' => 'Kewangan2',
            'status' => 'active', 
        ]);
        $function3->save();

        $function4 = Function_::create([
            'id' => '4',
            'name' => 'Kewangan3',
            'status' => 'active',
        ]);
        $function4->save();

        $function5 = Function_::create([
            'id' => '5',
            'name' => 'Kewangan4',
            'status' => 'active',
        ]);
        $function5->save();

        $function6 = Function_::create([
            'id' => '6',
            'name' => 'Kewangan5',
            'status' => 'active',
        ]);
        $function6->save();

        $function7 = Function_::create([
            'id' => '7',
            'name' => 'Kewangan6',
            'status' => 'active',
        ]);
        $function7->save();

        $function8 = Function_::create([
            'id' => '8',
            'name' => 'Kewangan7',
            'status' => 'active',
        ]);
        $function8->save();

        $function9 = Function_::create([
            'id' => '9',
            'name' => 'Kewangan8',
            'status' => 'active',
        ]);
        $function9->save();

        $function10 = Function_::create([
            'id' => '10',
            'name' => 'Kewangan9',
            'status' => 'active',
        ]);
        $function10->save();

        $function11 = Function_::create([
            'id' => '11',
            'name' => 'Kewangan10',
            'status' => 'active',
        ]);
        $function11->save();

        $function12 = Function_::create([
            'id' => '12',
            'name' => 'Pelanggan1 (Internal)',
            'status' => 'active',
        ]);
        $function12->save();

        $function13 = Function_::create([
            'id' => '13',
            'name' => 'Pelanggan1 (External)',
            'status' => 'active',
        ]);
        $function13->save();

        $function14 = Function_::create([
            'id' => '14',
            'name' => 'Pelanggan2 (External)',
            'status' => 'active',
        ]);
        $function14->save();

        $function15 = Function_::create([
            'id' => '15',
            'name' => 'Kecemerlangan Operasi1',
            'status' => 'active',
        ]);
        $function15->save();

        $function16 = Function_::create([
            'id' => '16',
            'name' => 'Kecemerlangan Operasi2',
            'status' => 'active',
        ]);
        $function16->save();

        $function17 = Function_::create([
            'id' => '17',
            'name' => 'Kecemerlangan Operasi3',
            'status' => 'active',
        ]);
        $function17->save();

        $function18 = Function_::create([
            'id' => '18',
            'name' => 'Kecemerlangan Operasi4',
            'status' => 'active',
        ]);
        $function18->save();

        $function19 = Function_::create([
            'id' => '19',
            'name' => 'Kecemerlangan Operasi5',
            'status' => 'active',
        ]);
        $function19->save();

        $function20 = Function_::create([
            'id' => '20',
            'name' => 'Kecemerlangan Operasi6',
            'status' => 'active',
        ]);
        $function20->save();

        $function21 = Function_::create([
            'id' => '21',
            'name' => 'Kecemerlangan Operasi7',
            'status' => 'active',
        ]);
        $function21->save();

        $function22 = Function_::create([
            'id' => '22',
            'name' => 'Kecemerlangan Operasi8',
            'status' => 'active',
        ]);
        $function22->save();

        $function23 = Function_::create([
            'id' => '23',
            'name' => 'Kecemerlangan Operasi9',
            'status' => 'active',
        ]);
        $function23->save();

        $function24 = Function_::create([
            'id' => '24',
            'name' => 'Kecemerlangan Operasi10',
            'status' => 'active',
        ]);
        $function24->save();

        $function25 = Function_::create([
            'id' => '25',
            'name' => 'Manusia & Proses1 (Training)',
            'status' => 'active',
        ]);
        $function25->save();

        $function26 = Function_::create([
            'id' => '26',
            'name' => 'Manusia & Proses1 (NCROFI)',
            'status' => 'active',
        ]);
        $function26->save();

        $function27 = Function_::create([
            'id' => '27',
            'name' => 'Kolaborasi1',
            'status' => 'active',
        ]);
        $function27->save();
    }
}
