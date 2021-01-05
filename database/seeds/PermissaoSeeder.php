<?php

use App\Permissao;
use Illuminate\Database\Seeder;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user
        $usuarios1 = Permissao::firstOrCreate([
            'nome' =>'usuario-view',
            'descricao' =>'Acesso a lista de Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'usuario-create',
            'descricao' =>'Adicionar Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'usuario-edit',
            'descricao' =>'Editar Usuários'
        ]);
        $usuarios3 = Permissao::firstOrCreate([
            'nome' =>'usuario-delete',
            'descricao' =>'Deletar Usuários'
        ]);
        $usuario4 = Permissao::firstOrCreate([
            'nome' => 'usuario-block',
            'descricao' => 'Bloquear usuário'
        ]);
        $usuario5 = Permissao::firstOrCreate([
            'nome' => 'usuario-orientar',
            'descricao' => 'Permite orientar projetos'
        ]);
        $usuario6 = Permissao::firstOrCreate([
            'nome' => 'view-myjob',
            'descricao' => 'Visualizar o próprio trabalho'
        ]);
        $usuario6 = Permissao::firstOrCreate([
            'nome' => 'edit-myjob',
            'descricao' => 'editar o próprio trabalho'
        ]);
        

        //trabalhos
        $trabalho1 = Permissao::firstOrCreate([
            'nome' =>'trabalho-view',
            'descricao' =>'Acesso a lista de trabalhos'
        ]);
        $trabalho2 = Permissao::firstOrCreate([
            'nome' =>'trabalho-create',
            'descricao' =>'Adicionar trabalho'
        ]);
        $trabalho3 = Permissao::firstOrCreate([
            'nome' =>'trabalho-edit',
            'descricao' =>'Editar trabalho'
        ]);
        $trabalho4 = Permissao::firstOrCreate([
            'nome' =>'trabalho-delete',
            'descricao' =>'Deletar trabalho'
        ]);
    }
}
