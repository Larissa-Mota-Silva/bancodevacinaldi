<?php
#Aqui estão todas as funções criadas para a tabela "usuario" do banco de dados "vacinaldi"

function incluirUsuario($login, $senha, $nome){#Função que inclui um novo usuário a tabela
    $c = conectarBancoVacina();

    if (is_numeric($login) && is_numeric($senha) && is_string($nome)){
        $result = mysqli_query($c, "INSERT INTO usuario(login, senha, nome)
                                    VALUES ('$login', '$senha', '$nome');");

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

function consultarUsuario(){#Função para consultar todos os registros da tabela
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM usuario");
    return $consulta;
}

function consultarEspUsuario($login){#Função para consultar os registros da tabela pela chave primária, no caso, login
    $c = conectarBancoVacina();
    $consulta = mysqli_query($c, "SELECT * FROM usuario WHERE login= '$login'");
    return $consulta;
}

function alterarUsuario($login, $senha, $nome){#Função para alterar os dados de um usuário na tabela
    if (is_numeric($login) && is_numeric($senha) && is_string($nome)){
        $c = conectarBancoVacina();
        $sql = "UPDATE usuario SET nome= '$nome', senha= '$senha' WHERE login= '$login'";
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

function logarUsuario($login, $senha){#Função para verificar (logar) um usuário, por enquanto permanece apenas com a mensagem superficial confirmando o login
    if (is_numeric($login) && is_numeric($senha)){
        $c = conectarBancoVacina();

        $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha';";
        $result = mysqli_query($c, $sql);

        if (mysqli_affected_rows($c) == 0){
            echo "<br>" . "Login não feito." . "<br>";
            return false;
        }
        else{
            echo "<br>" . "Login feito." . "<br>";
            return true;
        }
    }
    else{
        echo "Parametro invalido" . "<br>";
        return false;
    }
}

?>
