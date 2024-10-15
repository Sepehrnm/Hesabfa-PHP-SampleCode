<?php
error_reporting(0);
include "../API/class-api.php";
$api = new Ssbhesabfa_Api();
global $result, $errorCode, $errorMessage;

if(isset($_POST["deleteInvoice"])) {
    $number = $_POST["number"];
    $type = $_POST["type"];
    $result = $api->invoiceDelete($number, $type);
    $errorCode = $result->ErrorCode;
    $errorMessage = $result->ErrorMessage;
    if($result->{"Result"}) {
        echo '<script>alert("حذف گردید")</script>';
    }
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
<div>
    <?php
    if(isset($result->{"Success"}) && isset($errorCode)) {
        include '../Errors/errorLog.php';
    }
    ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                حذف فاکتور
            </h3>
            <br>
            <form method="post" style="direction: rtl;" class="save-document-form save-contact-form">
                <div class="halign">
                    <div class="align">
                        <label class="label-form" for="number">
                            <p>شماره فاکتور</p>
                        </label>
                        <input type="text" name="number">
                    </div>
                </div>
                <div class="halign">
                    <div class="align">
                        <label for="type" class="form-label">نوع فاکتور</label>
                        <select class="form-select" name="type">
                            <option selected>انتخاب کنید</option>
                            <option value="0">فروش</option>
                            <option value="1">خرید</option>
                            <option value="2">برگشت از فروش</option>
                            <option value="3">برگشت از خرید</option>
                            <option value="4">ضایعات</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <div class="align">
                    <button type="submit" name="deleteInvoice" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

