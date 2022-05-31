<?php
#Main da tabela "postosaude", aqui temos todas as verificações dos dados inseridos, e conexão com as functions que farão o resto do trabalho

include_once ('conectar.php');
include_once ('funcaopostosaude.php');

extract($_REQUEST, EXTR_OVERWRITE);#Ativação e verificação para incluir um posto de saúde na tabela com as informações do html
if (isset($acao)){
    if ($acao == "incluir"){
        if (isset($cnes) && isset($nome_ubs) && isset($endereco) && isset($cidade) && isset($cep)){
            $cnes = htmlspecialchars_decode(strip_tags($cnes));
            $nome_ubs = htmlspecialchars_decode(strip_tags($nome_ubs));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $cidade = htmlspecialchars_decode(strip_tags($cidade));
            $cep = htmlspecialchars_decode(strip_tags($cep));
        }
        if (incluirPosto($cnes, $nome_ubs, $endereco, $cidade, $cep)){
            echo "<br>" . "O posto de saúde incluido com sucesso" . "<br>";
        }
        else{
            echo "<br>" . "O posto de saúde não foi incluido" . "<br>";
        }
    }
}

if (isset($acao2)){#Ativação do comando para consultar todos os registros na tabela
    if ($acao2 == "consultar todos")
    {
        $testaConsulta = consultarPosto();
        $qtdlinhas = mysqli_num_rows($testaConsulta);

        if ($qtdlinhas == 0){
            echo "<br>" . "Não existe registros na tabela" . "<br>";
        }
        else{
            for ($i = 0;$i < $qtdlinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Consulta da tabela 'postosaude': " . "<br>" . "CNES= " . $linha['cnes'] . "<br>" . 
                "Nome da UBS= " . $linha['nome_ubs'] . "<br>" . "Endereço= " . $linha['endereco'] . "<br>" . "Cidade= " . 
                $linha['cidade'] . "<br>" . "CEP= " . $linha['cep'] . "<br>" . "<br>";
            }
        }
    }
}

if (isset($acao3)){#Ativação e verificação para consultar os registros da tabela pela chave primária, no caso, cnes
    if ($acao3 == "consultar posto"){
        if (isset($cnes)){
            $cnes = htmlspecialchars_decode(strip_tags($cnes));
            $testaEspConsulta = consultarEspPosto($cnes);
            $qtdlinhas = mysqli_num_rows($testaEspConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não existe esse registro na tabela" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++)
                {
                    $linha = mysqli_fetch_assoc($testaEspConsulta);
                    echo "<br>" . "Consulta específica da tabela 'postosaude': " . "<br>" . "CNES= " . $linha['cnes'] . "<br>" . 
                    "Nome da UBS= " . $linha['nome_ubs'] . "<br>" . "Endereço= " . $linha['endereco'] . "<br>" . "Cidade= " . 
                    $linha['cidade'] . "<br>" . "CEP= " . $linha['cep'] . "<br>" . "<br>";
                }
            }
        }
    }
}

if (isset($acao4)){#Ativação e verificação para alterar os dados de um posto de saúde na tabela com as informações do html
    if ($acao4 == "alterar posto"){
        if (isset($cnes) && isset($nome_ubs) && isset($endereco) && isset($cidade) && isset($cep)){
            $cnes = htmlspecialchars_decode(strip_tags($cnes));
            $nome_ubs = htmlspecialchars_decode(strip_tags($nome_ubs));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $cidade = htmlspecialchars_decode(strip_tags($cidade));
            $cep = htmlspecialchars_decode(strip_tags($cep));

        }
        if (alterarPosto($cnes, $nome_ubs, $endereco, $cidade, $cep)){
            echo "<br>" . "Posto alterado com sucesso" . "<br>";
        }
        else{
            echo "<br>" . "Posto não foi alterado" . "<br>";
        }
    }
}

if (isset($acao5)){#Ativação e verificação para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome, inserido no html
    if ($acao5 == "consultar nome UBS"){
        if (isset($nome_ubs)){
            $nome_ubs = htmlspecialchars_decode(strip_tags($nome_ubs));
            $testaNomeConsulta = consultarNomeUBS($nome_ubs);
            $qtdlinhas = mysqli_num_rows($testaNomeConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não há nome de UBS parecido." . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaNomeConsulta);
                    echo "<br>" . "Consulta pelo nome da UBS: " . "<br>" . "CNES= " . $linha['cnes'] . "<br>" . "Nome da UBS= " . 
                    $linha['nome_ubs'] . "<br>" . "Endereço= " . $linha['endereco'] . "<br>" . "Cidade= " . $linha['cidade'] . "<br>" . 
                    "CEP= " . $linha['cep'] . "<br>" . "<br>";
                }
            }
        }
    }
}

if (isset($acao6)){#Ativação e verificação para excluir um paciente do banco de dados pela sua chave primária, no caso, cnes
    if ($acao6 == "excluir UBS"){
        if (isset($cnes)){
            $cnes = htmlspecialchars_decode(strip_tags($cnes));
            $testarExcluir = excluirPosto($cnes);

            if ($testarExcluir){
                echo "<br>" . "UBS excluida com sucesso." . "<br>";
            }
            else{
                echo "<br>" . "UBS não foi excluida com sucesso." . "<br>";
            }
        }
    }
}

?>
