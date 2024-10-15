<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;

$result = $api->settingGetFiscalYears();

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست سال مالی</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result) { $fiscalYears = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست سال مالی
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>نام سال مالی</th>
                <th>تاریخ شروع سال مالی</th>
                <th>تاریخ پایان سال مالی</th>
                <?php foreach($fiscalYears as $fiscalYear) { ?>
                    <tr>
                        <td><?php echo $fiscalYear->Name; ?></td>
                        <td><?php echo $fiscalYear->StartDate; ?></td>
                        <td><?php echo $fiscalYear->EndDate; ?></td>
                    </tr>
                <?php } } else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>
</body>
</html>