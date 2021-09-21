<?php

namespace Database\Seeders;

use App\Models\Pessoa;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pessoa = [
            'id'      => 1,
            'user_id' => 2,
            'cpf'     => '222.222.222-22',
        ]; 
        Pessoa::insert($pessoa); 
    }
}
