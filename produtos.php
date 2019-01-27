<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include "bootstrap.php";
?>

<script>
$(document).ready(function() {
    $('#tab_produtos').DataTable({
    paging: false,
    searching: false,
    "columnDefs": [{targets: [ 3 ], orderSequence: [ "desc", "asc" ]  }],
    "order": [],
    "aoColumns": [{
            "bSortable": true
        },
        {
            "bSortable": true
 
        },
        {
            "bSortable": true
        }
         
        ],
        "bInfo": false
});
} );
</script>

</head>

<body>
<?php
include "conexao.php";

$busca = "SELECT * from produto";
$retorna_busca = mysqli_query($db, $busca);

$section = "products";
include "menu.php";
?>

<div class="container">

<div class="jumbotron">
        <h1>Stock Control</h1>
        <p>Products list</p>
      </div>


<button type="button" class="btn btn-primary" onclick="location.href='novo_produto.php'">New Product</button>



<div class="row">


        <div class="col-md-12">
          <table id="tab_produtos" class="table table-striped">
            <thead>
              <tr>
                <th>Name <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>Description <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>Price <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
<?php

while($retorno = mysqli_fetch_object($retorna_busca))
{		
	echo "<tr><td>" . $retorno->nome . "</td>";
	echo "<td>" . $retorno->descricao . "</td>";
	echo "<td>£ <span class=\"dinheiro\">" . $retorno->preco . "</span></td>";
	echo "<td><a href=\"edit_produto.php?id=" . $retorno->idproduto . "\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> | <a href=\"apagar_produto.php?id=" . $retorno->idproduto . "\" onclick=\"return confirm('Are you sure you want to delete this product?')\" title=\"Delete\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>";
 
}
	
	?>
	</tbody>
    </table>
    </div>
        <?php
	

mysqli_free_result($retorna_busca);

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