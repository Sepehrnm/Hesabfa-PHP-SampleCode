<?php
error_reporting(0);
include '../API/class-api.php';
global $result;
$api = new Ssbhesabfa_Api();
if(isset($_POST["deleteReceipt"])) {
    $type = $_POST["type"];
    $number = $_POST["number"];
    $data = [
        "type" => $type,
        "number" => $number
    ];

    $result = $api->deleteReceipt($data);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>حذف رسید</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
    if($result->{"Result"}) {
        echo "<script>alert('رسید حذف گردید')</script>";
    } else {
        include '../Errors/errorLog.php';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                حذف رسید
            </h3>
            <br>
            <form  method="post" class="save-contact-form">
                <div class="align">
                    <label for="type" class="form-label">نوع رسید</label>
                    <select class="form-select" name="type">
                        <option selected>انتخاب کنید</option>
                        <option value="1">دریافت</option>
                        <option value="2">پرداخت</option>
                    </select>
                </div>
                <br>
                <div class="align">
                    <label for="number">شماره رسید مورد نظر</label>
                    <input class="form-control" type="text" name="number" />
                </div>
                <br>
                <button class="btn btn-danger" type="submit" name="deleteReceipt">حذف رسید</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

