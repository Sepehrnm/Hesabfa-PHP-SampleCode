<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;

$result = $api->settingGetCurrencyTable();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت جدول نرخ برابری ارزها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result->{"Result"} != null) { $projects = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت جدول نرخ برابری ارزها
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>از</th>
                <th>به</th>
                <th>ضریب تبدیل</th>
                <?php foreach ($projects as $project) { ?>
                    <tr>
                        <td><?php echo $project->From; ?></td>
                        <td><?php echo $project->To; ?></td>
                        <td><?php echo $project->Rate; ?></td>
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