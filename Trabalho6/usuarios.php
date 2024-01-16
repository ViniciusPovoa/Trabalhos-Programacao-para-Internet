<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Lista de Usuários</h1>
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="filtro-nome" placeholder="Digite Nome ou CPF">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="botao-buscar" onclick="buscarUsuarios()">Buscar Usuários</button>
        </div>
    </div>
    <div class="alert alert-success" role="alert" id="mensagem-sucesso" style="display: none;">
        Sucesso, encontrou XX usuários!
    </div>
    <div class="alert alert-danger" role="alert" id="mensagem-erro" style="display: none;">
        Não encontrou nenhum usuário.
    </div>
    <table id="listar-usuario" class="display" style="width:100%">
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
            </tr>
        </thead>
    </table>

    <input type="button" class="btn btn-primary" value="Limpar Dados" onclick="limparDados()"></input>
    <script>
        var dataTable;

        document.addEventListener("DOMContentLoaded", function () {
            dataTable = $('#listar-usuario').DataTable({
                ajax: 'listar_usuarios.php',
                processing: true,
                serverSide: true,
                searching: true
            });
            dataTable.on('draw.dt', function () {
        var totalUsuarios = dataTable.rows().count();
        mudarLabel(totalUsuarios);
    });
        });

        function limparDados() {
            var tabela = document.getElementById('listar-usuario');
            var corpo = tabela.getElementsByTagName('tbody')[0];
            var linhas = corpo.getElementsByTagName('tr');

            for (var i = 0; i < linhas.length; i++) {
                var celulas = linhas[i].getElementsByTagName('td');
                for (var j = 0; j < celulas.length; j++) {
                    celulas[j].textContent = '-';
                }
            }
            
            alert("Os dados serão limpos!");    

        }

        function buscarUsuarios() {
            if (dataTable) {
                dataTable.search($('#filtro-nome').val()).draw(); 
        }
    }

        function mudarLabel(totalUsuarios){
            if (totalUsuarios > 0) {
                    document.getElementById('mensagem-sucesso').style.display = 'block';
                    document.getElementById('mensagem-erro').style.display = 'none';
                    document.getElementById('mensagem-sucesso').innerText = "Sucesso, encontrou " + totalUsuarios + " usuários!";
                } else {
                    document.getElementById('mensagem-sucesso').style.display = 'none';
                    document.getElementById('mensagem-erro').style.display = 'block';
                }
        }
    
    </script>
</body>
</html>
