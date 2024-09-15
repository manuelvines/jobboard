<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Victor Caudillo',
             'email' => 'vcaudillo@dkt.com.mx',
         ]);

         $countries = array(
            [
                'name' => 'Mexico',
                'code' => 'MX',
                'state_name'=> 'Estado'
            ],
            [
                'name' => 'Guatemala',
                'code' => 'GT',
                'state_name' => 'Departamento'
            ],
            [
                'name' => 'Costa Rica',
                'code' => 'CR',
                'state_name' => 'Provincia'
            ],
            [
                'name' => 'Panamá',	
                'code' => 'PA',
                'state_name' => 'Provincia'

            ],
            [
                'name' => 'El Salvador',
                'code' => 'SV',
                'state_name' => 'Departamento'
            ],
            [
                'name' => 'Venezuela',
                'code' => 'VE',
                'state_name' => 'Estado'
            ],
            [
                'name' => 'Honduras',
                'code' => 'HN',
                'state_name' => 'Departamento'
            ],
            [
                'name' => 'Dominicana',
                'code' => 'DO',
                'state_name' => 'Provincia'
            ],
           
         );


        $categories = ['Marketing','Finanzas','DKT School','Sistemas','RH'];
        
        foreach ($categories as $category) {
            \App\Models\Category::factory()->create(['name' => $category]);
        }

        foreach ($countries as $country) {
                \App\Models\Country::factory()->create($country);
        }

        $modalities = ['Presencial','Híbrido','Desde casa'];
        foreach ($modalities as $modality) {
            \App\Models\Modality::factory()->create(['name' => $modality]);
        }
        

        
        $educations = ['Primaria','Secundaria','Preparatoria','Universidad','Maestría','Doctorado'];
        foreach ($educations as $education) {
            \App\Models\Education::factory()->create(['name' => $education]);
        }
        

        $workdays = ['Tiempo completo','Medio tiempo','Por horas','Prácticas'];
        foreach ($workdays as $workday) {
            \App\Models\Workday::factory()->create(['name' => $workday]);
        }

        $types = ['Indeterminado','Temporal','Becario/Prácticas','Honorarios'];
        foreach ($types as $type) {
            \App\Models\Type::factory()->create(['name' => $type]);
        }

        $states = [
            [
                'name' => 'Jalisco',
                'country_id' => 1
            ],
            [
                'name' => 'Nuevo León',
                'country_id' => 1
            ],
            [
                'name' => 'CDMX',
                'country_id' => 1
            ],
            [
                'name' => 'Guatemala',
                'country_id' => 2
            ],
            [
                'name' => 'San José',
                'country_id' => 3
            ],
            [
                'name' => 'Panamá',
                'country_id' => 4
            ],
            [
                'name' => 'San Salvador',
                'country_id' => 5
            ],
            [
                'name' => 'Caracas',
                'country_id' => 6
            ],
            [
                'name' => 'Tegucigalpa',
                'country_id' => 7
            ],
            [
                'name' => 'Santo Domingo',
                'country_id' => 8
            ],
          
        ];

        foreach ($states as $state) {
            \App\Models\State::factory()->create($state);
        }

        
    }
}
