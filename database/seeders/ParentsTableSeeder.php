<?php

namespace Database\Seeders;

use App\Models\My_Parent;
use App\Models\Nationalite;
use App\Models\Religion;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my__parents')->delete();
        $my_parents = new My_Parent();
        $my_parents->Email = 'parent@yahoo.com';
        $my_parents->Password = Hash::make('12345678');
        $my_parents->Name_Father = ['en' => 'Father', 'ar' => 'أب'];
        $my_parents->National_ID_Father = '1234567810';
        $my_parents->Passport_ID_Father = '1234567810';
        $my_parents->Phone_Father = '1234567810';
        $my_parents->Job_Father = ['en' => 'Administrative', 'ar' => 'إداري'];
        $my_parents->Nationality_Father_id = Nationalite::all()->unique()->random()->id;
        $my_parents->Blood_Type_Father_id =Type_Blood::all()->unique()->random()->id;
        $my_parents->Religion_Father_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Father ='القاهرة جمهورية مصر العربية';
        $my_parents->Name_Mother = ['en' => 'Mother', 'ar' => 'أم'];
        $my_parents->National_ID_Mother = '1234567810';
        $my_parents->Passport_ID_Mother = '1234567810';
        $my_parents->Phone_Mother = '1234567810';
        $my_parents->Job_Mother = ['en' => 'Housewife', 'ar' => 'ربة منزل'];
        $my_parents->Nationality_Mother_id = Nationalite::all()->unique()->random()->id;
        $my_parents->Blood_Type_Mother_id =Type_Blood::all()->unique()->random()->id;
        $my_parents->Religion_Mother_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Mother =' القاهرة جمهورية مصر العربية';
        $my_parents->save();
    }
}
