<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
if(isset($_POST["deleteDocument"])) {
    $number = $_POST["number"];
    $result = $api->deleteDocument($number);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>حذف سند</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<div>
    <p class="color-danger bg-white p-2">توجه کنید که فقط اسناد دستی قابل حذف هستند</p>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                حذف سند حسابداری
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label class="form-label" for="number">شماره سند مورد نظر</label>
                </div>
                <input class="form-control" type="text" name="number" />
                <button class="btn btn-danger" type="submit" name="deleteDocument">حذف سند</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

