<?php
#Main da tabela "paciente", aqui temos todas as verificações dos dados inseridos, e conexão com as functions que farão o resto do trabalho

include_once ('conectar.php');
include_once ('funcaopaciente.php');
include_once ('funcoesData.php');

extract($_REQUEST, EXTR_SKIP);#Ativação e verificação para incluir um paciente na tabela com as informações do html
if (isset($acao)){
    if ($acao == "incluir"){
        if (isset($cpf) && isset($nome) && isset($idade) && isset($data_nascimento) && isset($endereco)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $idade = htmlspecialchars_decode(strip_tags($idade));
            $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));

            if (!validar_data($data_nascimento)){
                echo "Data informada é invalida!" . "<br>";
            }
            else{
                if (incluirPaciente($cpf, $nome, $idade, $data_nascimento, $endereco)){
                    echo "<br>" . "O paciente foi incluido com sucesso" . "<br>";
                }
            }
        }
        else{
            echo "<br>" . "O paciente não foi incluido" . "<br>";
        }
    }
}

if (isset($acao2)){#Ativação do comando para consultar todos os registros na tabela
    if ($acao2 == "consultar todos"){
        $testaConsulta = consultarPaciente();
        $qtdlinhas = mysqli_num_rows($testaConsulta);

        if ($qtdlinhas == 0){
            echo "<br>" . "Não existe registros na tabela";
        }
        else{
            for ($i = 0;$i < $qtdlinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Consulta da tabela 'paciente': " . "<br>" . "CPF= " . $linha['cpf'] . "<br>" . 
                "Nome= " . $linha['nome'] . "<br>" . "Idade= " . $linha['idade'] . "<br>" . "Data de nascimento= " . 
                formatarDataTela($linha['data_nascimento']) . "<br>" . "Endereço= " . $linha['endereco'] . "<br>";

            }
        }
    }
}

if (isset($acao3)){#Ativação e verificação para consultar os registros da tabela pela chave primária, no caso, cpf
    if ($acao3 == "consultar paciente"){
        if (isset($cpf)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testaEspConsulta = consultarEspPaciente($cpf);
            $qtdlinhas = mysqli_num_rows($testaEspConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não existe esse registro na tabela" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaEspConsulta);
                    echo "<br>" . "Consulta específica da tabela 'paciente': " . "<br>" . "CPF= " . $linha['cpf'] . "<br>" .
                    "Nome= " . $linha['nome'] . "<br>" . "Idade= " . $linha['idade'] . "<br>" . "Data de nascimento= " . 
                    formatarDataTela($linha['data_nascimento']) . "<br>" . "Endereço= " . $linha['endereco'] . "<br>" . "<br>";
                }
            }
        }
    }
}

if (isset($acao4)){#Ativação e verificação para alterar os dados de um paciente na tabela com as informações do html
    if ($acao4 == "alterar paciente"){
        if (isset($cpf) && isset($nome) && isset($idade) && isset($data_nascimento) && isset($endereco)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $idade = htmlspecialchars_decode(strip_tags($idade));
            $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));

            if (!validar_data($data_nascimento)){
                echo "Data informada é invalida!" . "<br>";
            }
            else{
                if (alterarPaciente($nome, $idade, $data_nascimento, $endereco, $cpf)){
                    echo "<br>" . "Paciente alterado com sucesso" . "<br>";
                }
                else{
                    echo "<br>" . "Paciente não foi alterado" . "<br>";
                }
            }
        }
    }
}

if (isset($acao5)){#Ativação e verificação para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome, inserido no html
    if ($acao5 == "consultar nome paciente"){
        if (isset($nome)){
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $testaNomeConsulta = consultarNomePaciente($nome);
            $qtdlinhas = mysqli_num_rows($testaNomeConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não há nome de paciente parecido." . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++)
                {
                    $linha = mysqli_fetch_assoc($testaNomeConsulta);
                    echo "<br>" . "Consulta pelo nome: " . "<br>" . "CPF= " . $linha['cpf'] . "<br>" . "Nome= " . $linha['nome'] . 
                    "<br>" . "Idade= " . $linha['idade'] . "<br>" . "Data de nascimento= " . formatarDataTela($linha['data_nascimento']) . 
                    "<br>" . "Endereço= " . $linha['endereco'] . "<br>";
                }
            }
        }
    }
}
if (isset($acao6)){#Ativação e verificação para excluir um paciente do banco de dados pela sua chave primária, no caso, cpf
    if ($acao6 == "excluir paciente"){
        if (isset($cpf)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testarExcluir = excluirPaciente($cpf);

            if ($testarExcluir)
            {
                echo "<br>" . "Paciente excluido com sucesso." . "<br>";
            }
            else
            {
                echo "<br>" . "Paciente não foi excluido com sucesso." . "<br>";
            }
        }
    }
}

?>
