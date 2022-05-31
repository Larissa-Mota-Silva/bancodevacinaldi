<?php
#Aqui estão as funções que validam as datas inseridas nos campos "data_nascimento" e "data_validade" das tabelas "paciente" e "vacina"

function validar_data($data){
    $v = explode("/", $data);
    if (count($v) == 3){
        $result = checkdate($v[1], $v[0], $v[2]);
        return $result;
    }
}

function formatardataBancoEnvio($data){
    $v = explode("/", $data);
    $dataBanco = $v[2] . '-' . $v[1] . '-' . $v[0];
    return $dataBanco;
}

function formatarDataTela($data){
    $v = explode('-', $data);
    $dataTela = $v[2] . '/' . $v[1] . '/' . $v[0];
    return $dataTela;
}
