<?php
error_reporting(0);
include '../API/class-api.php';
global $i, $rpp, $totalCount;
$api = new Ssbhesabfa_Api();

global $result;
$i = 0;
$rpp = 10;
$result = $api->settingGetSalesmen();
$totalCount = count($result->{"Result"});

if($totalCount % 10 != 0) $totalCount += 10;
if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<(($totalCount)/10) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);

            $result = $api->settingGetSalesmen();
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
    <title>دریافت لیست فروشنده ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<?php if($result) { $salesmen = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>
                دریافت لیست فروشنده ها
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>ID فروشنده</th>
                <th>کد فروشنده</th>
                <th>نام فروشنده</th>
                <th>فعال بودن فروشنده</th>
                <th>یادداشت</th>

                <?php for($j = $i ; $j < $rpp ; $j++) {
                    if(isset($salesmen[$j]->Id)) { ?>
                    <tr>
                        <td><?php echo $salesmen[$j]->Id; ?></td>
                        <td><?php echo $salesmen[$j]->Code; ?></td>
                        <td><?php echo $salesmen[$j]->Name; ?></td>
                        <td><?php if($salesmen[$j]->Active)  echo "فعال"; else echo "غیرفعال";?></td>
                        <td><?php echo $salesmen[$j]->Note; ?></td>

                    </tr>
                <?php   } } } else {echo "چیزی برای نمایش نیست";}?>
            </table>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?>
                            <input name="buttonInput[<?php echo $z;?>]" type="hidden" value="<?php echo $z;?>" />
                        </button>
                    <?php  } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>