<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include "bootstrap.php";


class Client{

  function newclient($nome, $email, $telefone)
  {
    $this->nome = $nome;
    $this->email = $email;
    $remove = array("(", ")", "-", " ");
    $this->telefone = str_replace($remove, "", $telefone);

    include "conexao.php";
    $query = mysqli_query($db, "INSERT INTO `cliente`(`nome`, `email`, `telefone`) VALUES ('$nome','$email','$telefone')");
    echo "<script>alert('New customer successfully added!')</script>";
    header('Location: clientes.php');
  }

}


if(isset($_POST['nome']))
{
  $newclient = new Client();
  $newclient->newclient($_POST['nome'], $_POST['email'], $_POST['telefone']);
}
?>


<script language="javascript" type="application/javascript">
function validateForm() {
	var nome = document.forms["add_user"]["nome"].value;
	if (nome == "") {
		alert("Field NAME cannot be empty");
    document.forms["add_user"]["nome"].focus();
		return false;
	}
	var senha = document.forms["add_user"]["email"].value;
	if (senha == "") {
		alert("Field EMAIL cannot be empty");
    document.forms["add_user"]["email"].focus();
		return false;
	}
	
	var senha = document.forms["add_user"]["telefone"].value;
	if (senha == "") {
		alert("Field PHONE cannot be empty");
    document.forms["add_user"]["telefone"].focus();
		return false;
	}

}

</script>
</head>

<body>
<?php
include "conexao.php";

$section = "customers";
include "menu.php";
?>


<div class="container">


    <div class="page-header">
        <h3>New Customer</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Customer's Info</h3>
            </div>
            <div class="panel-body">
            	<form name="add_user" id="add_user" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return validateForm()">

         <table class="table">
            
              <tr>
              <td class="col-md-1">Name</td><td class="col-md-11"><input type="text" name="nome" id="nome" class="form-control" autofocus></td></tr>
            
              <tr>
              <td class="col-md-1">Email</td><td class="col-md-11"><input type="text" name="email" id="email" class="form-control email"></td></tr>
              <tr>
              <td class="col-md-1">Phone</td><td class="col-md-11"><input type="text" name="telefone" id="telefone" class="form-control telefone"></td></tr>
</table>           

        <button class="btn btn-default" onclick="document.submit()">Add</button> <button type="button" class="btn btn-default" onclick="location.href='clientes.php'">Cancel</button></form>


 </div> 
          </div>
        </div>
      </div>
<?php include "footer.php"; ?>
</div>

<script>
  $(document).ready(function(){
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