<?php

include_once 'conexao.php';

$dados_requisicao = $_REQUEST;
$conexao = new Conexao();

$colunas = [
     0 => 'cpf',
     1 => 'nome     '
];

$query_qtd_usuarios = "SELECT COUNT(cpf) AS qtd_usuarios FROM usuarios";
$result_qtd_usuarios = $conexao->conexao->prepare($query_qtd_usuarios);
$result_qtd_usuarios->execute();
$row_qtd_usuarios = $result_qtd_usuarios->fetch(PDO::FETCH_ASSOC);

$query_usuarios = "SELECT cpf, nome FROM usuarios";

if (!empty($dados_requisicao['search']['value'])) {
    $query_usuarios .= " WHERE cpf LIKE :cpf OR nome LIKE :nome";
}

$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_usuarios = $conexao->conexao->prepare($query_usuarios);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);

if (!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_usuarios->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
}

$result_usuarios->execute();

$dados = [];

while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario);
    $registro = [];
    $registro[] = $cpf; 
    $registro[] = $nome;
    $dados[] = $registro;
}

$resultado = [
    "draw" => intval($dados_requisicao['draw']),
    "recordsTotal" => intval($row_qtd_usuarios['qtd_usuarios']),
    "data" => $dados
];

echo json_encode($resultado);

?>
