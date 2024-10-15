<?php
error_reporting(0);

include '../API/class-api.php';

$api = new Ssbhesabfa_Api();

$projects = $api->getProjects();
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت اطلاعات کسب و کار</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت اطلاعات کسب و کار
            </h3>
            <br>
            <table class="table info-table table-striped table-hover">
                <tr>
                    <th scope="row">نام کسب و کار</th>
                    <th scope="row">نام قانونی</th>
                    <th scope="row">تقویم</th>
                    <th scope="row">واحد پول اصلی</th>
                    <th scope="row">امکان استفاده از سیستم چند ارزی</th>
                    <th scope="row">سایر ارزها</th>
                    <th scope="row">طرح</th>
                    <th scope="row">اعتبار سند</th>
                    <th scope="row">تاریخ انقضا</th>
                </tr>
                <tr>
                    <td><p><?php echo $projects->{'Result'}->Name;?></p></td>
                    <td><p><?php echo $projects->{'Result'}->LegalName;?></p></td>
                    <td><p><?php echo $projects->{'Result'}->Calendar;?></p></td>
                    <td><p><?php echo $projects->{'Result'}->Currency;?></p></td>
                    <td><p><?php if($projects->{'Result'}->SupportMultiCurrency) echo "فعال"; else echo "غیرفعال";?></p></td>
                    <td><p><?php echo $projects->{'Result'}->OtherCurrencies;?></p></td>
                    <td><p><?php echo $projects->{'Result'}->Subscription;?></p></td>
                    <td><p><?php echo $projects->{'Result'}->Credit;?></p></td>
                    <td><p><?php echo (substr($projects->{'Result'}->ExpireDate, 0, 10)); ?></p></td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>

