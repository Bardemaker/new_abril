<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>
<link rel="icon" href="favicon.ico">
<?php
include "bootstrap.php";
?>
</head>

<body>
<?php
include "conexao.php";

$busca = mysqli_query($db, "SELECT * from cliente INNER JOIN pedido ON idcliente = id_cliente GROUP BY idcliente DESC");

$section = "home";
include "menu.php";

?>

<div class="container">


<div class="jumbotron">
  <h1>Stock Control</h1>
  <p>Orders made by customers</p>
</div>


<div class="row">
<?php

while($retorno = mysqli_fetch_object($busca))
{	
	echo "<div class=\"col-md-6\">";
	echo "<div class=\"well\">";
	echo "<span style=\"font-size:10px;\">Customer Name: </span><br><strong>" . $retorno->nome . "</strong><br>";
	
	$id_do_cliente = $retorno->id_cliente;
	$query = mysqli_query($db, "SELECT p.nome AS nome_produto, p.* FROM produto AS p INNER JOIN pedido AS pe on p.idproduto = pe.id_produto where pe.id_cliente = $id_do_cliente");	
	?>
	<p>
	<table class="table table-striped">
	<tr><th><span style="font-size:10px;">Product:</span></th>
	<th style="text-align:right"><span style="font-size:10px;">Price: </span></th></tr>
	
	<?php
	
	$total = 0;
	
	while($exibe = mysqli_fetch_object($query))
	{
		echo "<tr><td>";
		echo $exibe->descricao . "</td><td align=\"right\">£ <span class=\"dinheiro\">" . $exibe->preco . "</span>";
		$total += $exibe->preco;
		$total = number_format($total, 2, ',', '.');
		echo "</td></tr>";
	}
	//echo "<tr><td colspan=\"2\" align=\"right\"></td></tr>";
	echo "</table></p>";
	echo "<div class=\"badge\" style=\"float:right;margin:-10px;\">Total: £ <span class=\"dinheiro\">" . $total . "</span></div>";
	echo "</div></div>";
}

mysqli_free_result($busca);
mysqli_free_result($query);

?>

</div>
<?php include "footer.php"; ?>
</div>

<script>
  $(document).ready(function(){
  $('.dinheiro').mask('000,000,000,000,000.00', {reverse: true});
});
</script>
</body>
</html>