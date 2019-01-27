 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="margin-top:-5px;" href="./"><img src="images/logo_abril.png"></a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li <?php if($section == "home"){echo "class=\"active\"";} ?>><a href="./">Home</a></li>
              <li <?php if($section == "customers"){echo "class=\"active\"";} ?>><a href="clientes.php">Customers</a></li>
              <li <?php if($section == "products"){echo "class=\"active\"";} ?>><a href="produtos.php">Products</a></li>
              <li <?php if($section == "orders"){echo "class=\"active\"";} ?>><a href="compra.php">Make a new order</a></li>
            </ul>
        </div>
      </div>
    </nav>