<?php
include "conexao.php";

$id = $_GET['id'];

class Product{

  function Save($id, $nome, $descricao, $preco)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->descricao = $descricao;
    $this->preco = str_replace(",", ".", $preco);

    include "conexao.php";
    $query = mysqli_query($db, "UPDATE `produto` SET `nome`='$this->nome',`descricao`='$this->descricao',`preco`='$this->preco' WHERE `idproduto`='$this->id'");

     echo "<script>alert('Product is up to date!')</script>";
  }
}


if(isset($_POST['id']))
{
  $save = new Product();
  $save->save($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include "bootstrap.php";
?>

<script language="javascript" type="application/javascript">
function validateForm() {
	var nome = document.forms["edit_produto"]["nome"].value;
	if (nome == "") {
		alert("Field NAME cannot be empty");
		return false;
	}
	
	var email = document.forms["edit_produto"]["descricao"].value;
	if (email == "") {
		alert("Field DESCRIPTION cannot be empty");
		return false;
	}
	
	var telefone = document.forms["edit_produto"]["preco"].value;
	if (telefone == "") {
		alert("Field PRICE cannot be empty");
		return false;
	}

}
</script>

<script language="javascript" type="application/javascript">
function confirmaExclusao() {
var answer = confirm ("Are you sure you want to delete this product?")
if (answer)
window.location="apagar_produto.php?id=<?php echo $id;?>";
}
</script>

</head>

<body>
<?php




$busca = "SELECT * FROM produto where idproduto = '$id'";
$retorna_busca = mysqli_query($db, $busca);
$resultado = mysqli_fetch_object($retorna_busca);

$section = "products";
include "menu.php";
?>


<div class="container">

<?php


if (isset ($_GET['alerta']))
{
?>
<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign"></span> <strong>It was not possible to delete this product!</strong> It is on someone's order.
      </div>
<?php

}
?>


      <div class="page-header">
        <h3>Edit product</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $resultado->nome;?></h3>

            </div>
            <div class="panel-body">
              <!-- <form name="edit_produto" id="edit_produto" action="edit_produto_proc.php" method="post" onSubmit="return validateForm()"> -->
              <form name="edit_produto" id="edit_produto" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return validateForm()">
            	<input type="hidden" name="id" value="<?php echo $id; ?>">

         <table class="table">
            
              <tr>
              <td class="col-md-2">Name</td><td class="col-md-10"><input type="text" name="nome" id="nome" value="<?php echo $resultado->nome;?>" class="form-control"></td></tr>
            
              <tr>
              <td class="col-md-2">Description</td><td class="col-md-10"><textarea class="form-control" rows="5" name="descricao" id="descricao"><?php echo $resultado->descricao;?></textarea></td></tr>
              <tr>
              <td class="col-md-2">Price</td><td class="col-md-10"><input type="text" id="preco" name="preco" value="<?php echo $resultado->preco;?>" class="form-control dinheiro"></td></tr></table>           

        <button class="btn btn-default" onclick="document.submit()">Save</button> <button type="button" class="btn btn-default" onclick="location.href='produtos.php'">Cancel</button>      <button type="button" class="btn btn-warning" style="float:right"  onclick="confirmaExclusao();">Delete</button></form>


 </div> 
          </div>
        </div>
   <?php     
        
$query = "SELECT pe.*, cl.* FROM pedido AS pe INNER JOIN cliente AS cl ON pe.id_cliente = cl.idcliente where pe.id_produto = '$id'";
$res = mysqli_query($db, $query);
$linha = mysqli_num_rows($res);


if($linha != 0)
  	{

?>

<div class="col-sm-12">
<h3>Customers bought this product:</h3><br>
<table class="table table-striped">
<tr style="background-color:#ccc"><td><strong>Name</strong></td></tr>

<?php

  while($retorno = mysqli_fetch_object($res))
  {
  	
 	echo "<tr><td>" . $retorno->nome . "</td></tr>";

  }
  }
if($linha != 0)
  	{

?>

        
  </table>      
    </div>    
<?php
}
?>
        
      </div>

<?php include "footer.php";?>      
</div>

<script>
  $(document).ready(function(){
  $('.dinheiro').mask('000,000,000,000,000.00', {reverse: true});
});
</script>
</body>
</html>