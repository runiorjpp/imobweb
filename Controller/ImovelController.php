<?php

namespace App\Controller;

use App\Models\Notifications;
use App\Models\Imovel;
use App\Models\Dao\ImovelDao;
use App\Models\Dao\ProprietarioDao;
use App\Models\Dao\FinalidadeDao;
use App\Models\Dao\TipoImovelDao;
use App\Services\ImovelService;
use App\Services\FileUploadServices;

class ImovelController extends Notifications
{
    private $imovelService;
    private $imovelDao;
    private $tipoimovelDao;
    private $finalidadeDao;
    private $proprietarioDao;
    private $fileUploadService;

    public function __construct()
    {
        $this->tipoimovelDao = new TipoImovelDao();
        $this->imovelDao = new ImovelDao();
        $this->finalidadeDao = new FinalidadeDao();
        $this->proprietarioDao = new ProprietarioDao();
        $this->imovelService = new ImovelService($this->imovelDao);
        $this->fileUploadService = new FileUploadServices('lib/img/upload');
    }


    function index()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            $imovel = $this->imovelDao->listarPorId($id);
        endif;


        if ($_SERVER['REQUEST_METHOD'] == 'POST'):

            if (!empty($_POST['id'])):
                $this->atualizar($_POST, $_FILES);
            else:
                $this->inserir($_POST, $_FILES);
            endif;

        endif;

        $finalidade = $this->finalidadeDao->listarTodos();
        $tipoimovel = $this->tipoimovelDao->listarTodos();
        $proprietario = $this->proprietarioDao->listarTodos();

        require_once "Views/painel/index.php";
    }

    public function inserir($dados, $file)
    {
        $imagem = $this->fileUploadService->upload($file['imagemcapa']);
        $retorno = $this->imovelService->cadastrarImovel($dados, $imagem);
        echo $this->success('Imovel', 'Cadastrar', 'listar');
    }
    #metodo responsavel por gerenciar os dados de cadastro de imagem de um imovel
    public function cadastrarImagemImovel()
    {
        $id = $_GET['id'] ?? null;

        if ($id):
            $imovel = $this->imovelDao->listarPorId($id);
        endif;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagens']['name'])):
            $imagens = $this->fileUploadService->uploadMultiplo($_FILES['imagens'], $imovel[0]->ID);
            if (!empty($imagens)):
                $this->imovelService->cadastrarImagemImovel($_POST, $imagens);
                echo $this->success("Imovel", "Cadastrado", "listar");
            endif;
        endif;
        require_once "Views/painel/index.php";
    }

    function listar()
    {
        $finalidade = $this->finalidadeDao->listarTodos();
        $tipoimovel = $this->tipoimovelDao->listarTodos();
        $proprietario = $this->proprietarioDao->listarTodos();

        $imovel = $this->imovelDao->listarTodos();
        require_once "Views/painel/index.php";
    }

    function atualizar($dados, $file)
    {
        $imagem = $this->fileUploadService->upload($file['imagemcapa']);
        $retorno = $this->imovelService->atualizarImovel($dados, $imagem);
        echo $this->success('Imovel', 'Atualizar', 'listar');
    }

    function deleteConfirm()
    {

        $id = $_GET['id'] ?? null;
        if ($id):
            echo $this->confirm('Excluir', 'Imovel', '', $id);
        endif;
        require_once "Views/shared/header.php";
    }

    function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id):
            //  $ret = $this->proprietarioDao->excluir($id);
            $this->imovelDao->excluir($id);
            echo $this->success('Imovel', 'Excluido', 'listar');
        endif;

        require_once "Views/shared/header.php";
    }

    public function alterarStatus()
    {

        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $imovel = new Imovel($id, '', '', '', '', '', '', '', '', '', '', '', '', $ativo, '', '', '', '');
            $this->imovelDao->atualizar($imovel);
        #$this->success("Imovel", "Atualizado", "listar");
        endif;
    }

    public function listarImagemImovel()
    {
        $id = $_GET['id'] ?? null;
        $imagens = $this->imovelDao->listarImagemImovel($id);
        $imovel = $this->imovelDao->listarPorId($id);

        require_once "Views/imovel/detalhes.php";
    }
}
