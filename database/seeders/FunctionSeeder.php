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
        ]);
        $function1->save();
        
        $function2 = Function_::create([
            'id' => '2',
            'name' => 'Kewangan1',    
        ]);
        $function2->save();

        $function3 = Function_::create([
            'id' => '3',
            'name' => 'Kewangan2', 
        ]);
        $function3->save();

        $function4 = Function_::create([
            'id' => '4',
            'name' => 'Kewangan3',
        ]);
        $function4->save();

        $function5 = Function_::create([
            'id' => '5',
            'name' => 'Kewangan4',
        ]);
        $function5->save();

        $function6 = Function_::create([
            'id' => '6',
            'name' => 'Kewangan5',
        ]);
        $function6->save();

        $function7 = Function_::create([
            'id' => '7',
            'name' => 'Kewangan6',
        ]);
        $function7->save();

        $function8 = Function_::create([
            'id' => '8',
            'name' => 'Kewangan7',
        ]);
        $function8->save();

        $function9 = Function_::create([
            'id' => '9',
            'name' => 'Kewangan8',
        ]);
        $function9->save();

        $function10 = Function_::create([
            'id' => '10',
            'name' => 'Kewangan9',
        ]);
        $function10->save();

        $function11 = Function_::create([
            'id' => '11',
            'name' => 'Kewangan10',
        ]);
        $function11->save();

        $function12 = Function_::create([
            'id' => '12',
            'name' => 'Pelanggan1 (Internal)',
        ]);
        $function12->save();

        $function13 = Function_::create([
            'id' => '13',
            'name' => 'Pelanggan1 (External)',
        ]);
        $function13->save();

        $function14 = Function_::create([
            'id' => '14',
            'name' => 'Pelanggan2 (External)',
        ]);
        $function14->save();

        $function15 = Function_::create([
            'id' => '15',
            'name' => 'Kecemerlangan Operasi1',
        ]);
        $function15->save();

        $function16 = Function_::create([
            'id' => '16',
            'name' => 'Kecemerlangan Operasi2',
        ]);
        $function16->save();

        $function17 = Function_::create([
            'id' => '17',
            'name' => 'Kecemerlangan Operasi3',
        ]);
        $function17->save();

        $function18 = Function_::create([
            'id' => '18',
            'name' => 'Kecemerlangan Operasi4',
        ]);
        $function18->save();

        $function19 = Function_::create([
            'id' => '19',
            'name' => 'Kecemerlangan Operasi5',
        ]);
        $function19->save();

        $function20 = Function_::create([
            'id' => '20',
            'name' => 'Manusia & Proses1 (Training)',
        ]);
        $function20->save();

        $function21 = Function_::create([
            'id' => '21',
            'name' => 'Manusia & Proses1 (NCROFI)',
        ]);
        $function21->save();

        $function22 = Function_::create([
            'id' => '22',
            'name' => 'Kolaborasi1',
        ]);
        $function22->save();
    }
}
