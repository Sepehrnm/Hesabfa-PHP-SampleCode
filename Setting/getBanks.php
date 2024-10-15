<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;
$result = $api->settingGetBanks();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست بانک ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<?php if($result) { $changes = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست بانک ها
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>ID بانک</th>
                <th>کد بانک</th>
                <th>شماره حساب</th>
                <th>نام بانک</th>
                <th>شعبه</th>
                <th>واحد پول</th>

            <?php foreach ($changes as $change) { ?>
                <tr>
                    <td><?php echo $change->Id; ?></td>
                    <td><?php echo $change->Code; ?></td>
                    <td><?php echo $change->AccountNumber; ?></td>
                    <td><?php echo $change->Name; ?></td>
                    <td><?php echo $change->Branch; ?></td>
                    <td><?php echo $change->Currency; ?></td>

                </tr>
            <?php   }  } else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>

</body>
</html>