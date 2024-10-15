<?php
error_reporting(0);
include '../API/class-api.php';
global $i,$rpp;
$i=0;
$rpp=10;
$api = new Ssbhesabfa_Api();

global $result, $totalCount;

$result = $api->getQuantity();
$totalCount = count($result->{"Result"});

if($totalCount % 10 != 0) $totalCount+=10;
if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<=(($totalCount)/10) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);

            $Result = $api->getQuantity();
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
    <title>لیست موجودی کالاها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<?php if($result) { $items = $result->{'Result'};
if($items) {
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>لیست موجودی کالا یا خدمات</h3>
            <br>
            <table class="table table-striped table-hover">
                <th>کد حسابداری کالا</th>
                <th>تعداد</th>
                <th>بارکد کالا/خدمات</th>
                <th>کد کالا یا خدمات</th>
                <th>قیمت فروش</th>
                <?php

                    for($j=$i ; $j<$rpp ; $j++) {
                        if($items[$j]->Code) { ?>
                    <tr>
                        <td><?php echo $items[$j]->Code; ?></td>
                        <td><?php echo $items[$j]->Quantity; ?></td>
                        <td><?php echo $items[$j]->Barcode; ?></td>
                        <td><?php echo $items[$j]->ProductCode; ?></td>
                        <td><?php echo $items[$j]->SellPrice; ?></td>
                    </tr>
                <?php   } } } } else {echo "جیزی برای نمایش نیست";}?>
            </table>
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