<?php
#Main da tabela "usuario", aqui temos todas as verificações dos dados inseridos, e conexão com as functions que farão o resto do trabalho

include_once ('conectar.php');
include_once ('funcaousuario.php');

extract($_REQUEST, EXTR_SKIP);#Ativação e verificação para incluir um usuário na tabela com as informações do html
if (isset($acao)){
    if ($acao == "incluir"){
        if (isset($login) && isset($senha) && isset($nome)){
            $login = htmlspecialchars_decode(strip_tags($login));
            $senha = htmlspecialchars_decode(strip_tags($senha));
            $nome = htmlspecialchars_decode(strip_tags($nome));
        }
        if (incluirUsuario($login, $senha, $nome)){
            echo "<br>" . "Usúario incluido com sucesso" . "<br>";
        }
        else{
            echo "<br>" . "Usúario não foi incluido" . "<br>";
        }
    }
}

if (isset($acao2)){#Ativação do comando para consultar todos os registros na tabela
    if ($acao2 == "consultar todos"){
        $testaConsulta = consultarUsuario();
        $qtdlinhas = mysqli_num_rows($testaConsulta);

        if ($qtdlinhas == 0){
            echo "<br>" . "Não existe registros na tabela" . "<br>";
        }
        else{
            for ($i = 0;$i < $qtdlinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Consulta da tabela 'usuario': " . "<br>" . "Login= " . $linha['login'] . "<br>" . 
                "Senha= " . $linha['senha'] . "<br>" . "Nome= " . $linha['nome'] . "<br>" . "<br>";
            }
        }
    }
}

if (isset($acao3)){#Ativação e verificação para consultar os registros da tabela pela chave primária, no caso, login
    if ($acao3 == "consultar usuario"){
        if (isset($login)){
            $login = htmlspecialchars_decode(strip_tags($login));
            $testaEspConsulta = consultarEspUsuario($login);
            $qtdlinhas = mysqli_num_rows($testaEspConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não existe esse registro na tabela" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++)
                {
                    $linha = mysqli_fetch_assoc($testaEspConsulta);
                    echo "<br>" . "Consulta específica da tabela 'usuario': " . "<br>" . "Login= " . $linha['login'] . "<br>" . 
                    "Senha= " . $linha['senha'] . "<br>" . "Nome= " . $linha['nome'] . "<br>" . "<br>";
                }
            }
        }
    }
}

if (isset($acao4)){#Ativação e verificação para alterar os dados de um usuário na tabela com as informações do html
    if ($acao4 == "alterar usuario"){
        if (isset($login) && isset($senha) && isset($nome)){
            $login = htmlspecialchars_decode(strip_tags($login));
            $senha = htmlspecialchars_decode(strip_tags($senha));
            $nome = htmlspecialchars_decode(strip_tags($nome));
        }
        if (alterarUsuario($login, $senha, $nome)){
            echo "<br>" . "Usuário alterado com sucesso" . "<br>";
        }
        else{
            echo "<br>" . "Usuário não foi alterado" . "<br>";
        }
    }
}

if (isset($acao7)){#Ativação e verificação para verificar (logar) um usuário
    if ($acao7 == "Logar"){
        if (isset($login) && isset($senha)){
            $login = htmlspecialchars_decode(strip_tags($login));
            $senha = htmlspecialchars_decode(strip_tags($senha));

            if (logarUsuario($login, $senha)){
                echo "<br>" . "Usuário logado!" . "<br>";
            }
            else{
                echo "<br>" . "Usuário não logado" . "<br>";
            }
        }
    }
}

?>