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
            <div id="cadastro">Lista de novos talentos
            </div>
        </div>
        <div>
            <table id="tabela" border="2">
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Profissão</th>
                    <th>Endereço</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Opções</th>
                </tr>

                <?php
                    $conexao = new mysqli('localhost', 'root', '', 'talentos');
                    
                    if(!empty($_GET['id'])) {
                        $query = "DELETE FROM profissionais WHERE id = " . $_GET['id'] . ";";
                        $conexao->query($query);
                    }

                    $query = "SELECT * FROM profissionais;";
                    $lista = $conexao->query($query);

                    while($pessoa = $lista->fetch_assoc()) {
                        echo '
                            <tr>
                                <td>' . $pessoa['nome'] . '</td>
                                <td>' . $pessoa['idade'] . ' anos</td>
                                <td>' . $pessoa['profissao'] . '</td>
                                <td>' . $pessoa['endereco'] . '</td>
                                <td>' . formatarDataHora($pessoa['entrada']) . '</td>
                                <td>' . formatarDataHora($pessoa['saida']) . '</td>
                                <td>
                                    <a href="editar.php?id=' . $pessoa['id'] . '">Editar</a>
                                    <a href="#" onclick="excluir(' . $pessoa['id'] . ')">Excluir</a>
                                </td>
                            </tr>
                        ';
                    }

                    function formatarDataHora($dataHora) {
                        if($dataHora) {
                            $dataHora = DateTime::createFromFormat('Y-m-d H:i:s', $dataHora);
                            return $dataHora->format('d/m/Y') . ' às ' . $dataHora->format('H:i:s');
                        }
                    }
                ?>
            </table>
        </div>
        <script type="text/javascript">
            function excluir(id) {
                if(confirm("Você confirma o apagamento desse talento ?")) {
                    window.location = '?id=' + id;
                }
            }
        </script>
    </body>
</html>