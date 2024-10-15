<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش تراز آزمایشی</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <br>
            <h3>
                گزارش تراز آزمایشی
            </h3>
            <br>
            <form method="post" class="save-contact-form">
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
                        <label class="form-label" for="project">پروژه</label>
                        <input class="form-control" type="text" name="project">
                    </div>
                </div>
                    <button name="submitTrialBalance" class="btn btn-primary" type="submit">نمایش</button>
            </form>
            <div id="trialBalanceGridContainer"></div>
        </div>
    </div>
</div>
</body>
</html>

<?php
    error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result, $data;

    if(isset($_POST["submitTrialBalance"])) {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $project = $_POST["project"];

        $data = array(
            'startDate' => $startDate ? : null,
            'endDate' => $endDate ? : null,
            'project' => $project ? : null
        );
        $result = $api->reportTrialBalance($data);
        $jsConvertedResult = json_encode($result->Result);
        echo "<script> initializeGetTrialBalanceListPage('$jsConvertedResult'); </script>";
    }
?>