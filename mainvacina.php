<?php
#Main da tabela "vacina", aqui temos todas as verificações dos dados inseridos, e conexão com as functions que farão o resto do trabalho

include_once ('conectar.php');
include_once ('funcaovacina.php');
include_once ('funcoesData.php');

extract($_REQUEST, EXTR_SKIP);#Ativação e verificação para incluir uma vacina na tabela com as informações do html
if (isset($acao)){
    if ($acao == "incluir"){
        if (isset($num_lote) && isset($nome) && isset($fabricante) && isset($data_validade) && isset($distribuidora)){
            $num_lote = htmlspecialchars_decode(strip_tags($num_lote));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $fabricante = htmlspecialchars_decode(strip_tags($fabricante));
            $data_validade = htmlspecialchars_decode(strip_tags($data_validade));
            $distribuidora = htmlspecialchars_decode(strip_tags($distribuidora));

            if (!validar_data($data_validade)){
                echo "Data informada é invalida!" . "<br>";
            }
            else{
                if (incluirVacina($num_lote, $nome, $fabricante, $data_validade, $distribuidora)){
                    echo "<br>" . "A vacina foi incluida com sucesso" . "<br>";
                }
            }
        }
        else{
            echo "<br>" . "A vacina não foi incluida" . "<br>";
        }
    }
}

if (isset($acao2)){#Ativação do comando para consultar todos os registros na tabela
    if ($acao2 == "consultar todos"){
        $testaConsulta = consultarVacina();
        $qtdlinhas = mysqli_num_rows($testaConsulta);

        if ($qtdlinhas == 0){
            echo "<br>" . "Não existe registros na tabela" . "<br>";
        }
        else{
            for ($i = 0;$i < $qtdlinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Consulta da tabela 'vacina': " . "<br>" . "Número do lote= " . $linha['num_lote'] . "<br>" . "Nome= " . $linha['nome'] . "<br>" . "Fabricante= " . $linha['fabricante'] . "<br>" . "Data de validade= " . formatarDataTela($linha['data_validade']) . "<br>" . "Distribuidora= " . $linha['distribuidora'] . "<br>";

            }
        }
    }
}

if (isset($acao3)){#Ativação e verificação para consultar os registros da tabela pela chave primária, no caso, num_lote
    if ($acao3 == "consultar vacina"){
        if (isset($num_lote)){
            $num_lote = htmlspecialchars_decode(strip_tags($num_lote));
            $testaEspConsulta = consultarEspVacina($num_lote);
            $qtdlinhas = mysqli_num_rows($testaEspConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não existe registros na tabela" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaEspConsulta);
                    echo "<br>" . "Consulta específica da tabela 'vacina': " . "<br>" . "Número do lote= " . $linha['num_lote'] . "<br>" . "Nome= " . $linha['nome'] . "<br>" . "Fabricante= " . $linha['fabricante'] . "<br>" . "Data de validade= " . formatarDataTela($linha['data_validade']) . "<br>" . "Distribuidora= " . $linha['distribuidora'] . "<br>";
                }
            }
        }
    }
}

if (isset($acao4)){#Ativação e verificação para alterar os dados de uma vacina na tabela com as informações do html
    if ($acao4 == "alterar vacina"){
        if (isset($num_lote) && isset($nome) && isset($fabricante) && isset($data_validade) && isset($distribuidora)){
            $num_lote = htmlspecialchars_decode(strip_tags($num_lote));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $fabricante = htmlspecialchars_decode(strip_tags($fabricante));
            $data_validade = htmlspecialchars_decode(strip_tags($data_validade));
            $distribuidora = htmlspecialchars_decode(strip_tags($distribuidora));

        }
        if (!validar_data($data_validade)){
            echo "Data informada é invalida!" . "<br>";
        }
        else{
            if (alterarVacina($num_lote, $nome, $fabricante, $data_validade, $distribuidora)){
                echo "<br>" . "Vacina alterada com sucesso" . "<br>";
            }
            else{
                echo "<br>" . "Vacina não foi alterada" . "<br>";
            }
        }
    }
}

if (isset($acao5)){#Ativação e verificação para consultar os registros da tabela por um dado que não seja chave primária, no caso, nome, inserido no html
    if ($acao5 == "consultar nome vacina"){
        if (isset($nome)){
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $testaNomeConsulta = consultarNomeVacina($nome);
            $qtdlinhas = mysqli_num_rows($testaNomeConsulta);

            if ($qtdlinhas == 0){
                echo "<br>" . "Não há nome de vacina parecido." . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdlinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaNomeConsulta);
                    echo "<br>" . "Consulta pelo nome da vacina: " . "<br>" . "Número do lote= " . $linha['num_lote'] . "<br>" . "Nome= " . $linha['nome'] . "<br>" . "Fabricante= " . $linha['fabricante'] . "<br>" . "Data de validade= " . formatarDataTela($linha['data_validade']) . "<br>" . "Distribuidora= " . $linha['distribuidora'] . "<br>";;
                }
            }
        }
    }
}

if (isset($acao6)){#Ativação e verificação para excluir um paciente do banco de dados pela sua chave primária, no caso, num_lote
    if ($acao6 == "excluir vacina"){
        if (isset($num_lote)){
            $num_lote = htmlspecialchars_decode(strip_tags($num_lote));
            $testarExcluir = excluirVacina($num_lote);

            if ($testarExcluir){
                echo "<br>" . "Vacina excluida com sucesso." . "<br>";
            }
            else{
                echo "<br>" . "Vacina não foi excluida com sucesso." . "<br>";
            }
        }
    }
}

?>
