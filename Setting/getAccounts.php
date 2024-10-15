<?php
error_reporting(0);
include '../API/class-api.php';
global $i,$rpp;
$i=0;
$rpp=10;
$api = new Ssbhesabfa_Api();

$result = $api->settingGetAccounts();
$totalCount = (count($result->{"Result"}));
$totalCount%10 !=0 ? $totalCount+=10 : $totalCount;

if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<=(($totalCount)/10) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);
            $result = $api->settingGetAccounts();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت جدول حساب ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<?php if($result->{"Result"} != null) { $accounts = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت جدول حساب ها
            </h3>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <th>نام حساب</th>
                    <th>مسیر حساب</th>
                    <th><a href="https://hesabfa.com/help/api/TypesTable#detail-type">نوع تفضیل</a></th>
                    <?php

                    for($j=$i ; $j<$rpp ; $j++) {
                        if($accounts[$j]->Name) {?>
                        <tr>
                            <td><?php echo $accounts[$j]->Name; ?></td>
                            <td><?php echo $accounts[$j]->FullPath; ?></td>
                            <td><?php echo $accounts[$j]->DetailType; ?></td>
                        </tr>
                    <?php } } } else {
                        echo($result->ErrorMessage);
                    }?>
                </table>
            </div>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?>
                            <input name="buttonInput[<?php echo $z;?>]" type="hidden" value="<?php echo $z;?>" />
                        </button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>