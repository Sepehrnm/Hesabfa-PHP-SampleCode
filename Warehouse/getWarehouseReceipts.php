<?php
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست</title>
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
                دریافت لیست حواله انبار
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="halign">
                    <div class="align">
                        <label for="type" class="form-label">نوع رسید یا حواله انبار</label>
                        <select name="type" id="type" class="form-select">
                            <option value="-1">انتخاب کنید</option>
                            <option value="1">رسید ورود به انبار</option>
                            <option value="2">حواله خروج از انبار</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="take" class="form-label">تعداد</label>
                        <input type="text" class="form-control" id="take" name="take">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="getWarehouseList">دریافت</button>
            </form>
            <div id="gridContainer"></div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST["getWarehouseList"])) {
        if($_POST["take"]) $take = $_POST["take"]; else $take = 20;
        $data = array(
            "type" => $_POST["type"],
            "queryInfo" => array(
                "SortBy" => "Date",
                "SortDesc" => true,
                "Take" => $take,
                "Skip" => 0 )
        );
        $result = $api->getWarehouseList($data);
        $jsConvertedResult = json_encode($result->Result->List);
        echo "<script> initializeReceiptsListPage($jsConvertedResult); </script>";
    }
?>
