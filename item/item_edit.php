<?php
require_once 'connection.php';
if (isset($_REQUEST['id'])) {
    try {
        $id = $_REQUEST['id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
    $query = $dbh->prepare('SELECT * FROM item WHERE id=:id'); //sql select query
    $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        extract($result);
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
if (isset($_REQUEST['btn_update'])) {
    try {
        $id = $_REQUEST['id'];
        $item_code = $_REQUEST['item_code'];
        $item_name = $_REQUEST['item_name'];
        $item_category = $_REQUEST['item_category'];
        $item_subcategory = $_REQUEST['item_subcategory'];
        $quantity = $_REQUEST['quantity'];
        $unit_price = $_REQUEST['unit_price'];
        if (!isset($errorMsg)) {
            $query = $dbh->prepare('UPDATE item SET item_code=:item_code,item_name=:item_name,item_category=:item_category,item_subcategory=:item_subcategory,quantity=:quantity,unit_price=:unit_price WHERE id=:id'); //sql update query
            $query->bindParam(':item_code', $item_code);
            $query->bindParam(':item_name', $item_name);
            $query->bindParam(':item_category', $item_category);
            $query->bindParam(':item_subcategory', $item_subcategory);
            $query->bindParam(':quantity', $quantity);
            //bind all parameter
            $query->bindParam(':unit_price', $unit_price);
            $query->bindParam(':id', $id);
            if ($query->execute()) {
                $updateMsg = 'File Update Successfully.......';
                header('refresh:3;customerview.php');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
    <title>PHP PDO File Upload Using MySQL:onlyxscript.blogspot.in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style type="text/css">
form {
    width: 50rem;
    height: 50rem;
    margin-left: 20REM;
}
</style>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="col-lg-12">
                <?php
    if (isset($errorMsg)) {
        ?>
                <div class="alert alert-danger">
                    <strong>WRONG ! <?php echo $errorMsg; ?></strong>
                </div>
                <?php
    }
    if (isset($updateMsg)) {
        ?>
                <div class="alert alert-success">
                    <strong>UPDATE ! <?php echo $updateMsg; ?></strong>
                </div>
                <?php
    }
    ?>
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
                                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Item Code</label>
                                        <input type="text" class="form-control" name="item_code" id=" item_code"
                                            value="<?php echo $item_code; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="item_name" id=" item_name"
                                            value="<?php echo $item_name; ?>">
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
                                        <input type="text" class="form-control" name="unit_price" id="unit_price "
                                            value="<?php echo $unit_price; ?>">
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
                                            <option value="<?php echo $result->id; ?>">
                                                <?php echo $result->sub_category; ?></option>
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
                                            <option value="<?php echo $result->id; ?>"><?php echo $result->category; ?>
                                            </option>
                                            <?php
    }
}?>
                                        </select>
                                    </div>
                                    <input type="submit" name="btn_update" class="btn btn-primary" value="Update">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>