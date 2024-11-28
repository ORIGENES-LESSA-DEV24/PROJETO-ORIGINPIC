<!doctype html>
<html lang ="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> recebedados </title>
</head>
<body>

<?php
$conexao = mysqli_connect("localhost", "root","","teste11");
//chegar conexao

if(!$conexao){
echo "NÃO CONECTADO";
}
echo "CONECTADO AO BANCO>>>>>>>>>>>";


//RECUPERAR E VERIFICAR JA EXISTE



$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];


$sql = "INSERT INTO teste11.dados(nome,email,telefone,mensagem) values('$nome','$email','$telefone','$mensagem')";

$resultado = mysqli_query($conexao, $sql); 
echo">>USUÁRIO CADASTRADO COM SUCESSO!<BR>";
echo "<a href='contato.html'>voltar</a>";


   


?>


</body>
</html>