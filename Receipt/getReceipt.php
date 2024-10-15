<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;
if(isset($_POST["getReceipt"])) {
    $type = $_POST["type"];
    $number = $_POST["number"];
    $data = [
        "type" => $type,
        "number" => $number
    ];

    $result = $api->getReceipt($data);
    $receipt = $result->{"Result"};
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>دریافت رسید دریافت یا پرداخت</title>
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
                دریافت رسید دریافت یا پرداخت
            </h3>
            <br>
            <form method="post" class="save-contact-form">
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
                    <label class="form-label" for="number">شماره رسید مورد نظر</label>
                    <input class="form-control" type="text" name="number" />
                </div>
                <button class="btn btn-primary" type="submit" name="getReceipt">دریافت رسید</button>
            </form>
            <br><br>
            <?php if(isset($receipt)) {?>
            <table class="table bigger-table table-striped table-hover">
                <th>ID</th>
                <th>شماره رسید</th>
                <th>تاریخ</th>
                <th>توضیحات</th>
                <th>مبلغ رسید</th>
                <th>واحد پول رسید</th>
                <th>نرخ برابری ارز</th>
                <th>ID شخص</th>
                <th>نام شخص</th>
                <th>کد شخص</th>
                <tr>
                    <td><?php echo $receipt->Id; ?></td>
                    <td><?php echo $receipt->Number; ?></td>
                    <td><?php echo $receipt->DateTime; ?></td>
                    <td><?php echo $receipt->Description; ?></td>
                    <td><?php echo $receipt->Amount; ?></td>
                    <td><?php echo $receipt->Currency; ?></td>
                    <td><?php echo $receipt->CurrencyRate; ?></td>
                    <td><?php echo($receipt->Items[0]->{"Contact"}->{"Id"}); ?></td>
                    <td><?php echo($receipt->Items[0]->{"Contact"}->{"Name"}); ?></td>
                    <td><?php echo($receipt->Items[0]->{"Contact"}->{"Code"}); ?></td>
                </tr>
                <?php  }  else {echo "چیزی برای نمایش نیست";}?>
            </table>

</div></div></div>
</body>
</html>

