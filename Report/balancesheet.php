<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش ترازنامه</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<br>
<h3>
    گزارش ترازنامه
</h3>
<br>
<form class="save-contact-form" method="post" style="direction: rtl;">
    <div class="halign">
        <div class="align">
            <label class="form-label" for="startDate">تاریخ شروع</label>
            <input class="form-control" type="text" name="startDate" placeholder="(2023-03-26T00:00:00)">
        </div>
        <div class="align">
            <label class="form-label" for="endDate">تاریخ پایان</label>
            <input class="form-control" type="text" name="endDate" placeholder="(2024-03-25T00:00:00)">
        </div>
        <div class="align">
            <label class="form-label" for="project">نام پروژه</label>
            <input class="form-control" type="text" name="project">
        </div>
    </div>
    <button name="submitRequest" class="btn btn-primary" type="submit">نمایش</button>
</form>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="simple-treeview"></div>
            <div id="total" class="alert alert-warning mt-4">
                <div id="assets"></div>
                <div id="equity"></div>
                <div id="liabilities"></div>
                <div id="profitOrLoss"></div>
            </div>
        </div>
    </div>
</div>

<?php
    error_reporting(0);
    include "../API/class-api.php";
    $api = new Ssbhesabfa_Api();
    global $result;

    if(isset($_POST["submitRequest"])) {
        $startDate = $_POST["startDate"] ? : null;
        $endDate = $_POST["endDate"] ? : null;
        $project = $_POST["project"] ? : null;

        $data = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'project' => $project
        );
        $result = $api->reportBalancesheet($data);
        $jsConvertedResult = json_encode($result->Result);

        echo "<script> initializeBalancesheetPage('$jsConvertedResult'); </script>";
    }
?>

</body>
</html>
