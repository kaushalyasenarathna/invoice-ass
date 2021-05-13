<?php
include_once 'connection.php';

if (isset($_POST['submit'])) {
    $invoice_no = $_POST['invoice_no'];
    $customer = $_POST['customer'];
    $item_count = $_POST['item_count'];
    $amount = $_POST['amount'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $sql = 'INSERT INTO  `invoice`(`invoice_no`,`customer`,`item_count`,`amount`  )VALUES(:invoice_no,:customer,:item_count,:amount ) ;INSERT INTO  `invoice_master`(`item_id`,`quantity`,`unit_price`,`invoice_no`,`amount` )VALUES(:item_id,:quantity,:unit_price ,:invoice_no,:amount  )';
    $query = $dbh->prepare($sql);
    $query->bindParam(':invoice_no', $invoice_no, PDO::PARAM_STR);
    $query->bindParam(':customer', $customer, PDO::PARAM_STR);
    $query->bindParam(':item_count', $item_count, PDO::PARAM_STR);
    $query->bindParam(':amount', $amount, PDO::PARAM_STR);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':unit_price', $unit_price, PDO::PARAM_STR);
    $query->execute();
    header('location:invoice_view.php');
}
 ?>



<!DOCTYPE html>
<html lang="en">
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
                            <input type="text" class="form-control" name="invoice_no" id=" invoice_no">
                        </div>
                        <div class="form-group">
                            <label>amount  </label>
                            <input type="text" class="form-control" name="amount" id=" amount">
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
                            <label>item_count</label>
                            <input type="text" class="form-control" name="item_count" id="item_count ">
                        </div>
                        <div class="form-group">
                            <label>customer</label>
                            <select name="customer" class="form-control">
                           <?php
                           $sql = 'SELECT * FROM customer';
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                          if ($query->rowCount() > 0) {
                              foreach ($results as $result) {
                                  ?>
                                <option value="<?php echo $result->id; ?>"><?php echo $result->first_name; ?></option>
                                <?php
                              }
                          }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Item</label>
                            <select name="item_id" class="form-control">
                           <?php
                           $sql = 'SELECT * FROM item';
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                          if ($query->rowCount() > 0) {
                              foreach ($results as $result) {
                                  ?>
                                <option value="<?php echo $result->id; ?>"><?php echo $result->item_name; ?></option>
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

	<script src="../main/js/app.js"></script>

 
 

</body>

</html>


 