<?php
// Conexão com o banco de dados (ajuste com suas credenciais)
$host = 'localhost';
$db = 'loja';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Receber os dados do carrinho (em formato JSON)
$cart = json_decode(file_get_contents("php://input"), true);

// Verificar se o carrinho não está vazio
if (empty($cart)) {
    echo json_encode(['success' => false, 'message' => 'Carrinho vazio']);
    exit;
}

// Inserir os itens no banco de dados
try {
    $pdo->beginTransaction();
    
    foreach ($cart as $item) {
        $stmt = $pdo->prepare("INSERT INTO compras (produto_nome, produto_preco) VALUES (?, ?)");
        $stmt->execute([$item['name'], $item['price']]);
    }
    
    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
