<?php
#Função que conecta o banco de dados "vacinaldi" ao PHP

function conectarBancoVacina(){
    $c = mysqli_connect("localhost", "root", "", "vacinaldi");

    if (mysqli_connect_errno() == 0){
        echo "Conexão estabelecida, podemos continuar!" . "<br>";
    }
    else{
        $msg = mysqli_connect_error();
        echo "Erro ao estabelecer conexão com o SQL." . "<br>" . "O MySQL retornou a seguinte mensagem: " . $msg . "<br>";
    }

    return $c;
}
?>