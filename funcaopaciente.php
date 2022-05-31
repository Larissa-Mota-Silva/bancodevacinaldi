<?php
#Aqui estão todas as funções criadas para a tabela "paciente" do banco de dados "vacinaldi"

function incluirPaciente($cpf, $nome, $idade, $data_nascimento, $endereco)#Função que inclui um novo paciente a tabela
{
    $c = conectarBancoVacina();

    if (is_numeric($cpf) && is_string($nome) && is_numeric($idade) && validar_data($data_nascimento) && is_string($endereco)){
        $data_nascimento = formatardataBancoEnvio($data_nascimento);
        $result = mysqli_query($c, "INSERT INTO paciente(cpf, nome, idade, data_nascimento, endereco )
                                    VALUES ('$cpf', '$nome', '$idade', '$data_nascimento', '$endereco');");

        if ($result){
            echo "<br>" . "Registro inserido com sucesso." . "<br>";
            return true;
        }
        else{
            $msg = mysqli_error($c);
            echo "<br>" . "Registro não foi inserido com sucesso. O MySQL retornou a seguinte mensagem: " . $msg . "<br>";
            return false;
        }
    }
    else{
        echo "<br>" . "Parametros invalidos." . "<br>";
        return false;
    }
}

function consultarPaciente(){#Função para consultar todos os registros da tabela
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM paciente");
    return $consulta;
}

function consultarEspPaciente($cpf){#Função para consultar os registros da tabela pela chave primária, no caso, cpf
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM paciente WHERE cpf= '$cpf'");
    return $consulta;
}

function alterarPaciente($nome, $idade, $data_nascimento, $endereco, $cpf){#Função para alterar os dados de um paciente na tabela
    if (is_string($nome) && is_numeric($idade) && is_string($data_nascimento) && is_string($endereco) && is_numeric($cpf)){
        $c = conectarBancoVacina();
        $data_nascimento = formatardataBancoEnvio($data_nascimento);
        $sql = "UPDATE paciente SET nome= '$nome', idade= '$idade', data_nascimento= '$data_nascimento', endereco= '$endereco' WHERE cpf= '$cpf'";
        $result = mysqli_query($c, $sql);

        if (mysqli_affected_rows($c) == 0){
            echo "<br>" . "Alteração não feita." . "<br>";
            return false;
        }
        else{
            echo "<br>" . "Alteração feita." . "<br>";
            return true;
        }
    }
    else{
        echo "<br>" . "Parametros invalidos." . "<br>";
        return false;
    }
}

function consultarNomePaciente($nome){#Função para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM paciente WHERE nome= '$nome'");
    return $consulta;
}

function excluirPaciente($cpf){#Função para excluir um paciente do banco de dados pela sua chave primária, no caso, cpf
    if (is_numeric($cpf)){
        $c = conectarBancoVacina();
        $sql = "DELETE FROM paciente WHERE cpf= '$cpf'";
        $result = mysqli_query($c, $sql);

        if (mysqli_affected_rows($c) == 0){
            echo "<br>" . "Exclusão não feita." . "<br>";
            return false;
        }
        else{
            echo "<br>" . "Exclusão feita." . "<br>";
            return true;
        }
    }
    else{
        echo "Parametro invalido." . "<br>";
        return false;
    }
}
?>
