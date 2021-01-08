<?php

use App\Papel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Papel::firstOrCreate([
            'nome' => 'Admin',
            'descricao' => 'Acesso total ao sistema'
        ]);

        $p2 = Papel::firstOrCreate([
            'nome' => 'Coordenador',
            'descricao' => 'Acesso total ao sistema'
        ]);

        $p3 = Papel::firstOrCreate([
            'nome' => 'Professor',
            'descricao' => 'Acesso ao sistema como Professor'
        ]);

        $p4 = Papel::firstOrCreate([
            'nome' => 'Aluno',
            'descricao' => 'Acesso ao sistema como Aluno'
        ]);
        $data = ['password' => 'admin'];
        $user1 = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@helptcc.com',
            'password' => Hash::make($data['password'])
        ]);
        
    }
}
