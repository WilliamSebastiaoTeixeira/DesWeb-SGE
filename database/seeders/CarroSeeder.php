<?php

namespace Database\Seeders;

use App\Models\Carro;
use Illuminate\Database\Seeder;

class CarroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $carro = [
                'id'      => 1,
                'pessoa_id' => 1, 
                'placa' => '1234567', 
                'modelo' => 'Fusca', 
                'ano' => '1995',
            ];  
            Carro::insert($carro); 
        }
    }
}
