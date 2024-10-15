<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

global $result;

$result = $api->settingGetCurrency();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت واحد پول</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>

<?php if($result) { $currency = $result->{'Result'};
if($currency) {
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت واحد پول
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th style="text-align: center;">واحد پول</th>
                <tr>
                    <td style="text-align: center;"><?php echo $currency->Currency; ?></td>
                </tr>
            <?php   }  } else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>

</body>
</html>