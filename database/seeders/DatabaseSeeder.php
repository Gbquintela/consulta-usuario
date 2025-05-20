<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /**
         * Teste de injeção manual de dados do usuario
         * */
        User::create([
            'name' => 'Gabriewl',
            'cpf' => '12345678991',
            'email' => 'gabrel@example.com',
            'telephone' => '319999999',
            'password' => '123'
        ]);
    }
}
