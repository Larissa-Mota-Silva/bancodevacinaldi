<?php
#Aqui estão todas as funções criadas para a tabela "postosaude" do banco de dados "vacinaldi"

function incluirPosto($cnes, $nome_ubs, $endereco, $cidade, $cep)#Função que inclui um novo posto de saúde a tabela
{
    $c = conectarBancoVacina();

    if (is_numeric($cnes) && is_string($nome_ubs) && is_string($endereco) && is_string($cidade) && is_numeric($cep)){
        $result = mysqli_query($c, "INSERT INTO postosaude(cnes, nome_ubs, endereco, cidade, cep)
                                    VALUES ('$cnes', '$nome_ubs', '$endereco', '$cidade', '$cep');");

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

function consultarPosto(){#Função para consultar todos os registros da tabela
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM postosaude");
    return $consulta;
}

function consultarEspPosto($cnes){#Função para consultar os registros da tabela pela chave primária, no caso, cnes
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM postosaude WHERE cnes= '$cnes'");
    return $consulta;
}

function alterarPosto($cnes, $nome_ubs, $endereco, $cidade, $cep){#Função para alterar os dados de um posto de saúde na tabela
    if (is_numeric($cnes) && is_string($nome_ubs) && is_string($endereco) && is_string($cidade) && is_numeric($cep)){
        $c = conectarBancoVacina();
        $sql = "UPDATE postosaude SET nome_ubs= '$nome_ubs', endereco= '$endereco', cidade= '$cidade', cep= '$cep' WHERE cnes= '$cnes'";
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

function consultarNomeUBS($nome_ubs){#Função para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM postosaude WHERE nome_ubs= '$nome_ubs'");
    return $consulta;
}

function excluirPosto($cnes){#Função para excluir um posto de saúde do banco de dados pela sua chave primária, no caso, cnes
    if (is_numeric($cnes)){
        $c = conectarBancoVacina();
        $sql = "DELETE FROM postosaude WHERE cnes= '$cnes'";
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
