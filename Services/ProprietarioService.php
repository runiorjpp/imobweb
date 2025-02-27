<?php

namespace App\Services;

use App\Models\Dao\ProprietarioDao;

use App\Models\Proprietario;

class ProprietarioService
{

    private $ProprietarioDao;

    public function __construct(ProprietarioDao $ProprietarioDao)
    {
        $this->ProprietarioDao = $ProprietarioDao;
    }

    public function cadastrarProprietario($dados)
    {
        $proprietario = new Proprietario();

        foreach ($dados as $key => $valores):
            $proprietario->$key = $valores;
        endforeach;

        return $this->ProprietarioDao->adicionar($proprietario);
    }

    public function atualizarProprietario($dados)
    {
        $proprietario = new Proprietario();

        foreach ($dados as $key => $valores):
            $proprietario->$key = $valores;
        endforeach;

        return $this->ProprietarioDao->atualizar($proprietario);
    }
}
