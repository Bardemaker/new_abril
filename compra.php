<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include 'bootstrap.php';


class Order{

  function neworder($cliente, $produto)
  {
    $this->cliente = $cliente;
    $this->produto = $produto;

    include "conexao.php";
    $query = mysqli_query($db, "INSERT INTO `pedido`(`id_produto`, `id_cliente`) VALUES ('$produto','$cliente')");
    header ('location: ./'); 
  }
}


if(isset($_POST['cliente']))
{
  $save = new Order();
  $save->neworder($_POST['cliente'], $_POST['produto']);
}

?>

<script language="javascript" type="application/javascript">
function validateForm() {
	var cliente = document.forms["add_compra"]["cliente"].value;
	if (cliente == "") {
		alert("Field CUSTOMER cannot be empty");
		return false;
	}
	var produto = document.forms["add_compra"]["produto"].value;
	if (produto == "") {
		alert("Field PRODUCT cannot be empty");
		return false;
	}
}

</script>

</head>

<body>
<?php
include "conexao.php";

$section = "orders";
include "menu.php";
?>

<div class="container">


    <div class="page-header">
        <h3>New order</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Order details</h3>
            </div>
            <div class="panel-body">
            	<form name="add_compra" id="add_compra" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return validateForm()">

         
         <table class="table">
                                   <tr>
              <td class="col-md-2">Customer</td><td class="col-md-10"><select class="form-control" id="cliente" name="cliente">
              <option value=""></option>
              
            
<?php
$query = "SELECT * FROM cliente ORDER BY nome";
$res = mysqli_query($db, $query);
while ($resultado = mysqli_fetch_object($res))
{
	echo "<option value=\"" . $resultado->idcliente . "\">";
	echo $resultado->nome;
	echo "</option>";
	
}
mysql_free_result($res);
?>


</select></td></tr>
         
         
            
              <tr>
              <td class="col-md-2">Product</td><td class="col-md-10"><select class="form-control" id="produto" name="produto">
              <option value=""></option>
              
            
<?php
$query = "SELECT * FROM produto ORDER BY descricao";
$res = mysqli_query($db, $query);
while ($resultado = mysqli_fetch_object($res))
{
	echo "<option value=\"" . $resultado->idproduto . "\">";
	echo $resultado->descricao . " - Price: £ " . $resultado->preco;
	echo "</option>";
	
}
mysqli_free_result($res);
?>


</select></td></tr>
</table>           

        <button class="btn btn-default" onclick="document.submit()">Submit</button> <button type="button" class="btn btn-default" onclick="location.href='./'">Cancel</button></form>


 </div> 
          </div>
        </div>
      </div>
<?php include "footer.php"?>
</div>

</body>
</html>