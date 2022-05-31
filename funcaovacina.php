<?php
#Aqui estão todas as funções criadas para a tabela "vacina" do banco de dados "vacinaldi"

function incluirVacina($num_lote, $nome, $fabricante, $data_validade, $distribuidora){#Função que inclui uma nova vacina a tabela
    $c = conectarBancoVacina();

    if (is_numeric($num_lote) && is_string($nome) && is_string($fabricante) && validar_data($data_validade) && is_string($distribuidora)){
        $data_validade = formatardataBancoEnvio($data_validade);
        $result = mysqli_query($c, "INSERT INTO vacina(num_lote, nome, fabricante, data_validade, distribuidora)
                                    VALUES ('$num_lote', '$nome', '$fabricante', '$data_validade', '$distribuidora');");

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

function consultarVacina(){#Função para consultar todos os registros da tabela
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM vacina");
    return $consulta;
}

function consultarEspVacina($num_lote){#Função para consultar os registros da tabela pela chave primária, no caso, num_lote
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM vacina WHERE num_lote= '$num_lote'");
    return $consulta;
}

function alterarVacina($num_lote, $nome, $fabricante, $data_validade, $distribuidora){#Função para alterar os dados de uma vacina na tabela
    if (is_numeric($num_lote) && is_string($nome) && is_string($fabricante) && is_string($data_validade) && is_string($distribuidora)){
        $c = conectarBancoVacina();
        $data_validade = formatardataBancoEnvio($data_validade);
        $sql = "UPDATE vacina SET nome= '$nome', fabricante= '$fabricante', data_validade= '$data_validade', distribuidora= '$distribuidora' WHERE num_lote= '$num_lote'";
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

function consultarNomeVacina($nome){#Função para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM vacina WHERE nome= '$nome'");
    return $consulta;
}

function excluirVacina($num_lote){#Função para excluir uma vacina do banco de dados pela sua chave primária, no caso, num_lote
    if (is_numeric($num_lote)){
        $c = conectarBancoVacina();
        $sql = "DELETE FROM vacina WHERE num_lote= '$num_lote'";
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