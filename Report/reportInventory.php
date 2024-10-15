<?php
error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result, $totalCount, $rpp, $i, $report, $startDate, $endDate, $data;
    if(!isset($_SESSION)) { session_start(); }
    $i = 0;
    $rpp = 10;

if(isset($_POST["submit"])) {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];

    if(isset($_SESSION)) {
        $_SESSION['startDate'] = $startDate;
        $_SESSION['endDate'] = $endDate;
    }

    $data = array(
        'startDate' => $startDate ? : null,
        'endDate' => $endDate ? : null
    );
}

if(isset($_GET["buttonSubmit"])) {
    $value = $_GET["buttonSubmit"];
    $URI = $_SERVER['REQUEST_URI'];
//    var_dump($URI);
    $position = strpos($URI, "buttonSubmit");
    $page = substr($URI, $position+20 , 2);
    $rpp = ($page * 10);
    $i = ($rpp - 10);
}

$startDate = $_SESSION['startDate'];
$endDate = $_SESSION['endDate'];

$data = array(
    'startDate' => $startDate ? : null,
    'endDate' => $endDate ? : null
);

$result = $api->reportInventory($data);
$report = $result->{"Result"};

$totalCount = count($report);

($totalCount % 10 ==  0) ? : $totalCount+=10;
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش موجودی کالا</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>
                گزارش موجودی کالا
            </h3>
            <br>
            <form class="save-contact-form" method="post" style="direction: rtl;">
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="startDate">تاریخ شروع</label>
                        <input class="form-control" type="text" name="startDate" placeholder="(yyyy-mm-ddT00:00:00)">
                    </div>
                    <div class="align">
                        <label class="form-label" for="endDate">تاریخ پایان</label>
                        <input class="form-control" type="text" name="endDate" placeholder="(yyyy-mm-ddT00:00:00)">
                    </div>
                </div>
                <br>
                <button name="submit" class="btn btn-primary" type="submit">نمایش</button>
            </form>
            <br>
            <?php
            if(isset($result)) {
            ?>
            <table class="table table-striped table-hover">
                <th>کدحسابداری</th>
                <th>نام</th>
                <th>نام دسته بندی</th>
                <th>مسیر دسته بندی</th>
                <th>کد محصول</th>
                <th>مبلغ</th>
                <th>تعداد</th>
                <th>واحد اصلی</th>
                <th>واحد فرعی</th>
                <th>موجودی اول دوره</th>
                <th>افزایش طی دوره</th>
                <th>کاهش طی دوره</th>

                <?php
                for($j=$i ; $j<$rpp ; $j++) {
                    if(isset($report[$j]->Code)) { ?>
                        <tr>
                            <td><?php echo $report[$j]->Code; ?></td>
                            <td><?php echo $report[$j]->Name; ?></td>
                            <td><?php echo $report[$j]->NodeName; ?></td>
                            <td><?php echo $report[$j]->NodeFamily; ?></td>
                            <td><?php echo $report[$j]->ProductCode; ?></td>
                            <td><?php echo $report[$j]->Amount; ?></td>
                            <td><?php echo $report[$j]->Quantity; ?></td>
                            <td><?php echo $report[$j]->MainUnit; ?></td>
                            <td><?php echo $report[$j]->SubUnit; ?></td>
                            <td><?php echo $report[$j]->Opening; ?></td>
                            <td><?php echo $report[$j]->Increase; ?></td>
                            <td><?php echo $report[$j]->Decrease; ?></td>
                        </tr>
                    <?php } } ?>
            </table>

            <form method="get">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?></button>
                    <?php  } ?>
                </div>
            </form>

            <?php }?>
        </div>
    </div>
</div>
</body>
</html>
