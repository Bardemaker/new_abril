<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include "bootstrap.php";


class Product{

  function newproduct($nome, $descricao, $preco)
  {
    $this->nome = $nome;
    $this->descricao = $descricao;
    $this->preco = str_replace(",", ".", $preco);

    include "conexao.php";
    $query = mysqli_query($db, "INSERT INTO `produto`(`nome`, `descricao`, `preco`) VALUES ('$this->nome','$this->descricao','$this->preco')");
    header ('location: produtos.php'); 
  }
}


if(isset($_POST['nome']))
{
  $save = new Product();
  $save->newproduct($_POST['nome'], $_POST['descricao'], $_POST['preco']);
}
?>


<script language="javascript" type="application/javascript">
function validateForm() {
	var nome = document.forms["add_produto"]["nome"].value;
	if (nome == "") {
		alert("Field NAME cannot be empty");
    document.forms["add_produto"]["nome"].focus();
		return false;
	}
	var senha = document.forms["add_produto"]["descricao"].value;
	if (senha == "") {
		alert("Field DESCRIPTION cannot be empty");
    document.forms["add_produto"]["descricao"].focus();
		return false;
	}
	
	var senha = document.forms["add_produto"]["preco"].value;
	if (senha == "") {
		alert("Field PRICE cannot be empty");
    document.forms["add_produto"]["preco"].focus();
		return false;
	}

}

</script>
</head>
<body>
<?php
include "conexao.php";

$section = "products";
include "menu.php";
?>
<div class="container">


    <div class="page-header">
        <h3>New Product</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Product Info</h3>
            </div>
            <div class="panel-body">
            	<form name="add_produto" id="add_produto" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return validateForm()">

         <table class="table">
            
              <tr>
              <td class="col-md-1">Name</td><td class="col-md-11"><input type="text" name="nome" id="nome" class="form-control" autofocus></td></tr>
            
              <tr>
              <td class="col-md-1">Description</td><td class="col-md-11">  <textarea class="form-control" rows="5" name="descricao" id="descricao"></textarea></td></tr>
              <tr>
              <td class="col-md-1">Price</td><td class="col-md-11"><input type="text" name="preco" id="preco" class="form-control dinheiro"></td></tr>
</table>           

        <button class="btn btn-default" onclick="document.submit()">Add</button> <button type="button" class="btn btn-default" onclick="location.href='produtos.php'">Cancel</button></form>


 </div> 
          </div>
        </div>
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