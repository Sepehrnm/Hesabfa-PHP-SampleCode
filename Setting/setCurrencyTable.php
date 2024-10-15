<?php
error_reporting(0);
include '../API/class-api.php';
global $result;
$api = new Ssbhesabfa_Api();

if(isset($_POST["submitCurrency"])) {
    $from = $_POST["from"];
    $to = $_POST["to"];
    $rate = $_POST["rate"];

    $table = array(array(
        'From' => $from,
        'To' => $to,
        'Rate' => $rate
    ));

    $result = $api->settingSetCurrencyTable($table);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تنظیم جدول نرخ برابری ارزها</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
    if($result->{"Result"}) {
        echo "<script>alert('ثبت گردید')</script>";
    } else {
        include '../Errors/errorLog.php';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                تنظیم جدول نرخ برابری ارزها
            </h3>
            <br>
            <p class="text-danger bg-white p-2" style="border-radius: 3px;">با فراخوانی این متد می توانید جدول نرخ برابری ارزها را تنظیم کنید. دقت کنید که ارز با ارزش تر را در قسمت From قرار دهید، به عبارت دیگر نرخ برابری نباید از یک کمتر باشد.</p>
            <form class="save-contact-form" method="post">
                <div class="valign">
                    <div class="align" style="padding: 0.5rem;">
                        <label class="form-label" for="from">از</label>
                        <input type="text" class="form-input" name="from">
                    </div>
                    <div class="align" style="padding: 0.5rem;">
                        <label class="form-label" for="to">به</label>
                        <input type="text" class="form-input" name="to">
                    </div>
                    <div class="align" style="padding: 0.5rem;">
                        <label class="form-label" for="rate">ضریب تبدیل</label>
                        <input type="text" class="form-input" name="rate">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="submitCurrency">ذخیره</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>