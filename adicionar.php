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
            <a id="inicial" href="index.php">Consulte a lista de talentos</a>  
            <a id="inicial" href="adicionar.php">Cadastrar um novo talento</a>
        </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if(empty($_POST['nome'])) {
                        echo 'Nome do talento não foi informado';
                    }else if(empty($_POST['idade'])) {
                        echo 'Idade do talento  não foi informada';
                    }else if(empty($_POST['profissao'])) {
                        echo 'Profissao do talento não foi informada';
                    }else if(empty($_POST['endereco'])) {
                        echo 'Endereço do talento não foi informado';
                    }else if(empty($_POST['entrada'])) {
                        echo 'Entrada não foi informada';
                    } else {
                        $conexao = new mysqli('localhost', 'root', '', 'talentos');
                        $query = "INSERT INTO profissionais
                                        (
                                            nome,
                                            idade,
                                            profissao,
                                            endereco,
                                            entrada
                                            ". (!empty($_POST['saida']) ? ', saida' : '') ."
                                        )
                                    VALUES
                                        (
                                            '". addslashes($_POST['nome']) ."',
                                            ". $_POST['idade'] .",
                                            '". addslashes($_POST['profissao']) ."',
                                            '". addslashes($_POST['endereco']) ."',
                                            '". $_POST['entrada'] ."'
                                            ". (!empty($_POST['saida']) ? ", '". $_POST['saida'] ."'" : '') ."
                                        );";
                        // echo $query;
                        $conexao->query($query);
                        header('Location: index.php');
                    }
                }
            ?>
            <form id="tabela" method="POST">
                <div>
                    Nome: <input name="nome" type="text" />
                </div>
                <div>
                    Idade: <input name="idade" type="number" />
                </div>
                <div>
                    Profissão: <input name="profissao" type="text" />
                </div>
                <div>
                    Endereço: <input name="endereco" type="text" />
                </div>
                <div>
                    Entrada: <input name="entrada" type="datetime-local" />
                </div>
                <div>
                    Saída (opcional): <input name="saida" type="datetime-local" />
                </div>
                <div>
                    <input type="submit" />
                </div>
            </form>
        </div>
    </body>
</html>