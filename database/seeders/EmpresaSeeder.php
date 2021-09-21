<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa = [
            'id'      => 1,
            'user_id' => 1, 
            'cnpj'    => '11.111.111/1111-11',
        ]; 
        Empresa::insert($empresa); 
    }
}
