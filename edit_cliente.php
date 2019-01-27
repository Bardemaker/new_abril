<?php
include "conexao.php";

$id = $_GET['id'];


class Client{

  function save($id, $nome, $email, $telefone)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->email = $email;
    $remove = array("(", ")", "-", " ");
    $this->telefone = str_replace($remove, "", $telefone);

    include "conexao.php";
    $query = mysqli_query($db, "UPDATE `cliente` SET `nome`='$this->nome',`email`='$this->email',`telefone`='$this->telefone' WHERE `idcliente`='$this->id'");

    echo "<script>alert('Infos is up to date!')</script>";
  }
}

if(isset($_POST['id']))
{
  $save = new Client();
  $save->save($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
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
	var nome = document.forms["edit_user"]["nome"].value;
	if (nome == "") {
		alert("Field NAME cannot be empty");
		return false;
	}
	
	var email = document.forms["edit_user"]["email"].value;
	if (email == "") {
		alert("Field EMAIL cannot be empty");
		return false;
	}
	
	var telefone = document.forms["edit_user"]["telefone"].value;
	if (telefone == "") {
		alert("Field PHONE cannot be empty");
		return false;
	}

}
</script>

<script language="javascript" type="application/javascript">
function confirmaExclusao() {
var answer = confirm ("Are you sure you want to delete this customer?")
if (answer)
window.location="apagar_cliente.php?id=<?php echo $id;?>";
}
</script>

</head>

<body>
<?php




$busca = "SELECT * FROM cliente where idcliente = '$id'";
$retorna_busca = mysqli_query($db, $busca);
$resultado = mysqli_fetch_object($retorna_busca);

$section = "customers";
include "menu.php";
?>

<div class="container">

<?php


if (isset ($_GET['alerta']))
{
?>
<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign"></span> <strong>It was not possible to delete this customer!</strong> There are orders associated to him/her.
      </div>
<?php

}
?>


      <div class="page-header">
        <h3>Edit customer</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $resultado->nome;?></h3>

            </div>
            <div class="panel-body">
            	<form name="edit_user" id="edit_user" action="<?php $_SERVER ['PHP_SELF']; ?>" method="post" onSubmit="return validateForm()">
              <!-- <form name="edit_user" id="edit_user" action="edit_cliente_proc.php" method="post" onSubmit="return validateForm()"> -->
            	<input type="hidden" name="id" value="<?php echo $id; ?>">

         <table class="table">
            
              <tr>
              <td class="col-md-2">Name</td><td class="col-md-10"><input type="text" name="nome" id="nome" value="<?php echo $resultado->nome;?>" class="form-control"></td></tr>
            
              <tr>
              <td class="col-md-2">Email</td><td class="col-md-10"><input type="text" name="email" id="email" value="<?php echo $resultado->email;?>" class="form-control"></td></tr>
              <tr>
              <td class="col-md-2">Phone</td><td class="col-md-10"><input type="text" id="telefone" name="telefone" value="<?php echo $resultado->telefone;?>" class="form-control telefone"></td></tr></table>           

        <button class="btn btn-default" onclick="document.submit()">Save</button> <button type="button" class="btn btn-default" onclick="location.href='clientes.php'">Cancel</button>      <button type="button" class="btn btn-warning" style="float:right"  onclick="confirmaExclusao();">Delete</button></form>


 </div> 
          </div>
        </div>
   <?php     
        
$query = "SELECT pe.*, pr.* FROM pedido AS pe INNER JOIN produto AS pr ON pe.id_produto = pr.idproduto where pe.id_cliente = '$id'";
$res = mysqli_query($db, $query);
$linha = mysqli_num_rows($res);


if($linha != 0)
  	{

?>

<div class="col-sm-12">
<h3>Products bought by this customer:</h3><br>
<table class="table table-striped">
<tr style="background-color:#ccc"><td><strong>Product</strong></td><td><strong>Price</strong></td></tr>

<?php

  while($retorno = mysqli_fetch_object($res))
  {
  	
 	echo "<tr><td>" . $retorno->descricao . "</td><td>R$ <span class=\"dinheiro\">" . $retorno->preco . "</span></td></tr>";

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
<?php include "footer.php"; ?>      
</div>

<script>
  $(document).ready(function(){
    $('.dinheiro').mask('000,000,000,000,000.00', {reverse: true});

  
  $(".telefone").mask("(99) 99999-9999");

$(".telefone").on("blur", function() {
    var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

    if( last.length == 3 ) {
        var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = move + last;
        var first = $(this).val().substr( 0, 9 );

        $(this).val( first + '-' + lastfour );
    }
});
});
</script>
</body>
</html>