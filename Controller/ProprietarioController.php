<?php

namespace App\Controller;

use App\Models\Dao\ProprietarioDao;
use App\Models\Notifications;
use App\Models\Proprietario;
use App\Services\ProprietarioService;

class ProprietarioController extends Notifications
{
    private $propretarioService;

    private $proprietarioDao;
    public function __construct()
    {
        $this->proprietarioDao = new ProprietarioDao();
        $this->propretarioService = new ProprietarioService($this->proprietarioDao);
    }



    function index(): void
    {
        $id = $_GET['id'] ?? null;

        if ($id):
            $proprietario = $this->proprietarioDao->listarPorId($id);

        endif;


        if ($_POST):
            if (empty($_POST['id'])):
                $this->inserir($_POST);

            else:
                $this->atualizar($_POST);

            endif;
            $this->inserir($_POST);
        endif;

        require_once "Views/painel/index.php";
    }

    public function inserir($dados): void
    {
        $retorno = $this->propretarioService->cadastrarProprietario($dados);
        echo $this->success('Proprietario', 'Cadastrar', 'listar');
    }

    function listar(): void
    {
        $proprietario = $this->proprietarioDao->listarTodos();
        require_once "Views/painel/index.php";
    }

    function atualizar($dados)
    {
        $retorno = $this->propretarioService->atualizarProprietario($dados);
        echo $this->success('Proprietario', 'Atualizar', 'listar');
    }

    function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            echo $this->confirm('Excluir', 'Proprietario', '', $id,);

        endif;
        require_once "Views/shared/header.php";
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            $this->proprietarioDao->excluir($id);
            echo $this->success('Proprietario', 'Excluido', 'listar');

        endif;

        require_once "Views/shared/header.php";
    }

    public function alterarStatus()
    {

        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $proprietario = new Proprietario($id, '', '', '', $ativo);
            $this->proprietarioDao->atualizar($proprietario);
        #$this->success("Proprietario", "Atualizado", "listar");
        endif;
    }
}
