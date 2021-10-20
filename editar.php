/*
	* < UNIME >
	* < B.S.I >
	* < DESENVOLVIMENTO EM WEB 2 >
	* < PABLO ROXO >
	* < LUIS RICARDO SOUSA BORGES >
	*/


<!doctype html>
<html>
    <head>
        <title>Banco de talentos</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/estilo.css" />
    </head>
    <body>
    <div class="pagina">
      <div class="topo mrg50B">Banco de talentos</div>
     
        <ul>
          <li>
          </li>
        </ul>
      </div>
    </div>
        <div>
        <img id="inicial" src="img/entrevista.png" />  
            <a id="inicial" href="adicionar.php">Cadastrar um novo talento</a>
        </div>
            <?php
                $conexao = new mysqli('localhost', 'root', '', 'talentos');
                
                if($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(empty($_POST['nome'])) {
                        echo 'O nome editado não foi informado';
                    }else if(empty($_POST['idade'])) {
                        echo 'A idade editada não foi informada';
                    }else if(empty($_POST['profissao'])) {
                        echo 'A profissão editada não foi informada';
                    }else if(empty($_POST['endereco'])) {
                        echo 'O endereco editado não foi informado';
                    }else if(empty($_POST['entrada'])) {
                        echo 'Novo horario de entrada não foi informado';
                    } else {
                        $query = "UPDATE profissionais
                                    SET
                                        nome = '". addslashes($_POST['nome']) ."',
                                        idade = ". $_POST['idade'] .",
                                        profissao = '". addslashes($_POST['profissao']) ."',
                                        endereco = '". addslashes($_POST['endereco']) ."',
                                        entrada = '". $_POST['entrada'] ."'
                                        ". (!empty($_POST['saida']) ? ", saida = '" . $_POST['saida'] . "'" : '') ."
                                    WHERE id = " . $_POST['id'] . ";";
                        // echo $query;
                        $conexao->query($query);
                        header('Location: index.php');
                    }
                }

                $query = "SELECT * FROM profissionais WHERE id = " . $_GET['id'] . ";";
                $profissionais = $conexao->query($query);
                $profissionais = $profissionais->fetch_assoc();

                adaptarDataHora($profissionais['entrada']);

                function adaptarDataHora($dataHora) {
                    if($dataHora) {
                        $dataHora = str_replace(' ', 'T', $dataHora);
                        $dataHora = substr($dataHora, 0, 16);
                        return $dataHora;
                    }
                }
            ?>
            <form id="tabela" method="POST">
                <div>
                    Nome: <input name="nome" type="text" value="<?= $profissionais['nome'] ?>" />
                </div>
                <div>
                    Idade: <input name="idade" type="number" value="<?= $profissionais['idade'] ?>" />
                </div>
                <div>
                    Profissao: <input name="profissao" type="text" value="<?= $profissionais['profissao'] ?>" />
                </div>
                <div>
                    Endereço: <input name="endereco" type="text" value="<?= $profissionais['endereco'] ?>" />
                </div>
                <div>
                    Entrada: <input name="entrada" type="datetime-local" value="<?= adaptarDataHora($profissionais['entrada']) ?>" />
                </div>
                <div>
                    Saída (opcional): <input name="saida" type="datetime-local" value="<?= adaptarDataHora($profissionais['saida']) ?>" />
                </div>
                <div>
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
                    <input type="submit" />
                </div>
            </form>
        </div>
    </body>
</html>
