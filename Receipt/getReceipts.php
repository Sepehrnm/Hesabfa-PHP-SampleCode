<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

global $Result, $totalCount, $i, $rpp;
$i = 0;
$rpp = 10;

$query = array(
    "SortBy"=> 'DateTime',
    "SortAsce"=> true,
    "Take"=> 10,
    "Skip"=> 0
);

$data = array(
    "type" => '1',
    "queryInfo" => $query
);

$result = $api->getReceipts($data);
$totalCount = (($result->{"Result"}->TotalCount));

if($totalCount % 10 != 0) $totalCount += 10;
if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<(($totalCount)/10) ; $j++) {
        if(isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);
            $query = array(
                "SortBy" => "DateTime",
                "SortAsce" => true,
                "Take" => $rpp,
                "Skip" => $i
            );
            $data = array(
                "type" => '1',
                "queryInfo" => $query
            );
            $result = $api->getReceipts($data);
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
    <title>نمایش لیست رسیدهای دریافت یا پرداخت</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result) { $receipts = $result->{'Result'}->{'List'};

if($receipts) {
?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>
                نمایش لیست رسیدهای دریافت یا پرداخت
            </h3>
            <br>
            <table class="table bigger-table table-striped table-hover">
                <th>ID</th>
                <th>شماره رسید</th>
                <th>تاریخ رسید</th>
                <th>توضیحات</th>
                <th>مبلغ رسید</th>
                <th>واحد پول رسید</th>
                <th>نرخ برابری ارز</th>
                <th>ID شخص</th>
                <th>نام شخص</th>
                <th>کد شخص</th>
                <?php
                    foreach ($receipts as $receipt) {
                    if($i < $rpp) {
                    ?>
                    <tr>
                        <td><?php echo $receipt->Id; ?></td>
                        <td><?php echo $receipt->Number; ?></td>
                        <td><?php echo $receipt->DateTime; ?></td>
                        <td><?php echo $receipt->Description; ?></td>
                        <td><?php echo $receipt->Amount; ?></td>
                        <td><?php echo $receipt->Currency; ?></td>
                        <td><?php echo $receipt->CurrencyRate; ?></td>
                        <td><?php echo($receipt->Items[0]->{"Contact"}->{"Id"}); ?></td>
                        <td><?php echo($receipt->Items[0]->{"Contact"}->{"Name"}); ?></td>
                        <td><?php echo($receipt->Items[0]->{"Contact"}->{"Code"}); ?></td>
                    </tr>
                <?php  } $i++; } } } else {echo "چیزی برای نمایش نیست";}?>
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
