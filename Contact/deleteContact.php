<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
if(isset($_POST["deleteContact"])) {
    $code = $_POST["code"];

    $result = $api->deleteContact($code);
    if($result->{"Result"}) {
        echo "<script>alert('شخص حذف گردید')</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>حذف</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                حذف شخص
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label for="code">کد شخص مورد نظر</label>
                    <input type="text" name="code" />
                </div>
                <button class="btn btn-danger" type="submit" name="deleteContact">حذف شخص</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

