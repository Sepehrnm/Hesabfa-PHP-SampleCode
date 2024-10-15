<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

$result = $api->settingGetPettyCashes();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست تنخواه گردان ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result->{"Result"} != null) { $pettyCashes = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست تنخواه گردان ها
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>ID تنخواه گردان</th>
                <th>نام تنخواه گردان</th>
                <th>کد تنخواه گردان</th>
                <th>واحد پول</th>
                <?php foreach ($pettyCashes as $pettyCash) { ?>
                    <tr>
                        <td><?php echo $pettyCash->Id; ?></td>
                        <td><?php echo $pettyCash->Code; ?></td>
                        <td><?php echo $pettyCash->Name; ?></td>
                        <td><?php echo $pettyCash->Currency; ?></td>
                    </tr>
                <?php } } else {
                    echo($result->ErrorMessage);
                }?>
            </table>
        </div>
    </div>
</div>
</body>
</html>