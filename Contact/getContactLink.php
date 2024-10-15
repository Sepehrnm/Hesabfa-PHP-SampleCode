<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
if(isset($_POST["getContactLink"])) {
    $code = $_POST["code"];
    $showAllAccounts = $_POST["showAllAccounts"] ? : false;
    $days = $_POST["days"] ? $_POST["days"] : 30;

    $data = array(
        'code'=> $code,
        'showAllAccounts'=> $showAllAccounts,
        'days'=> $days
    );

    $result = $api->getContactLink($data);
    $contactLink = $result->{"Result"};
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <title>لینک کارت حساب</title>
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
                دریافت لینک کارت حساب
            </h3>
            <br>
        <form method="post" class="save-contact-form">
            <div class="align">
                <div class="align">
                    <label for="code" class="form-label">کد شخص مورد نظر</label>
                    <input type="text" name="code" class="form-control" />
                </div>
                <br>
                <div class="align">
                    <label for="showAllAccounts" class="form-label">نمایش سایر حسابها</label>
                    <input type="text" name="showAllAccounts" class="form-control" />
                </div>
                <br>
                <div class="align">
                    <label for="days" class="form-label">تعداد روز اعتبار</label>
                    <input type="text" name="days" class="form-control" />
                </div>
                <br>
                <button class="btn btn-primary" type="submit" name="getContactLink">دریافت</button>
            </div>
        </form>
        <br><br>
            <?php if(isset($contactLink)) {?>
            <table class="table table-striped table-hover">
                <th style="text-align: center;">لینک کارت حساب شخص</th>
                <tr>
                    <td style="text-align: center;"><?php echo $contactLink->Link; ?></td>
                </tr>
                <?php  }  else {echo "چیزی برای نمایش نیست";}?>
            </table>

        </div></div></div>
</body>
</html>

