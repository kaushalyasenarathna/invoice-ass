<?php
include_once 'connection.php';
if (isset($_POST['submit'])) {
    $item_code = $_POST['item_code'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $sql = 'INSERT INTO  `item`(`item_code`,`item_category`,`item_subcategory`,`item_name`,`quantity`,`unit_price`)VALUES(:item_code,:item_category,:item_subcategory,:item_name,:quantity,:unit_price)';
    $query = $dbh->prepare($sql);
    $query->bindParam(':item_code', $item_code, PDO::PARAM_STR);
    $query->bindParam(':item_category', $item_category, PDO::PARAM_STR);
    $query->bindParam(':item_subcategory', $item_subcategory, PDO::PARAM_STR);
    $query->bindParam(':item_name', $item_name, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':unit_price', $unit_price, PDO::PARAM_STR);
    $query->execute();
    header('location:item_create.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>
	<link href="../main/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrapper"> 
	<?php include '../main/nav.php'; ?>  
		<div class="main">
		<?php include '../main/header.php'; ?>  
			<main class="content">
				<div class="container-fluid p-0">
			 
                <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="iq-card-body">
                </div>
            </div>
            <div class="iq-card">
                <div class="iq-card-body">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                    <form action=" " name="insert" method="POST">
                        <div class="form-group">
                            <label>Item Code</label>
                            <input type="text" class="form-control" name="item_code" id=" item_code">
                        </div>
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" class="form-control" name="item_name" id=" item_name">
                        </div>
                        <div class="form-group">
                            <label>Quentity</label>
                            <select name="quantity" id="quantity" class="form-control">
                                <option value="1">1 </option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4 </option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="unit_price" id="unit_price ">
                        </div>
                        <div class="form-group">
                            <label>item_category</label>
                            <select name="item_subcategory" class="form-control">
                           <?php
                           $sql = 'SELECT * FROM item_subcategory';
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                          if ($query->rowCount() > 0) {
                              foreach ($results as $result) {
                                  ?>
                                <option value="<?php echo $result->id; ?>"><?php echo $result->sub_category; ?></option>
                                <?php
                              }
                          }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>item_category</label>
                            <select name="item_category" class="form-control">
                                <?php
    $sql = 'SELECT * FROM item_category';
    $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        ?>
                                <option value="<?php echo $result->id; ?>"><?php echo $result->category; ?></option>
                                <?php
    }
}?>
                            </select>
                        </div>
                        <input type="submit" value="Send" name="submit" type="button" class="btn btn-dark" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
				</div>
			</main>	
		</div>
	</div>

	<script src="../mainn/js/app.js"></script>


</body>
</html>