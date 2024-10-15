<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت حواله انبار
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label for="number" class="form-label">شماره رسید یا حواله</label>
                    <input type="text" name="number" id="number" class="form-control">
                </div>
                <br>
                <button class="btn btn-primary" name="getWarehouseReceipt">دریافت</button>
            </form>
            <div id="gridContainer"></div>
        </div>
    </div>
</div>

<?php
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();

    if(isset($_POST["getWarehouseReceipt"])) {

        $data = array(
            "number" => $_POST["number"]
        );

        $result = $api->getWarehouse($data);
        $jsConvertedResult = json_encode($result->Result);
        echo "<script> initializeReceiptPage($jsConvertedResult); </script>";
    }
?>
</body>
</html>
