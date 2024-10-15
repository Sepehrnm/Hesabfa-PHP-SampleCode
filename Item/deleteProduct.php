<?php
error_reporting(0);
include "../API/class-api.php";
$api = new Ssbhesabfa_Api();
global $result, $errorCode;

if(isset($_POST["deleteItem"])) {
    $code = $_POST["Code"];
    $result = $api->itemDelete($code);
    $errorCode = $result->ErrorCode;
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>حذف</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>حذف کالا یا خدمات</h3>
            <br>
            <form class="save-contact-form" action="deleteProduct.php" method="post" style="direction: rtl;">
                <div class="align">
                    <label for="Code">کد محصول</label>
                </div>
                <input type="text" name="Code">
                <button type="submit" name="deleteItem" class="btn btn-danger">حذف</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

