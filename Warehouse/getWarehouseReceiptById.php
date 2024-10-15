<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت از طریق ID</title>
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
                دریافت حواله انبار از طریق ID
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label for="id" class="form-label">id رسید و حواله انبار</label>
                    <input type="text" class="form-control" name="id" id="id" placeholder="1,2,3">
                </div>
                <br>
                <div class="align">
                    <button type="submit" class="btn btn-primary" name="getWarehouseReceipt">نمایش</button>
                </div>
                <br>
                <div id="gridContainer"></div>
            </form>
        </div>
    </div>
</div>
<?php
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();

    if(isset($_POST["getWarehouseReceipt"])) {
        $id = $_POST["id"];
        preg_match_all('/\d+/', $id, $matches);

        $idList = array_map('intval', $matches[0]);
        $data = array("idList" => $idList);

        $result = $api->getWarehouseById($data);
        $jsConvertedResult = json_encode($result->Result);
        echo "<script> initializeReceiptsByIDListPage($jsConvertedResult); </script>";
    }
?>
</body>
</html>
