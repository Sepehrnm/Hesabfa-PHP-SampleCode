<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
$type = 0;
$take = 10;
$skip = 0;
global $totalCount, $result;

$query = array(
    "SortBy" => "Date",
    "SortAsce" => true,
    "Take" => $take,
    "Skip" => $skip
);

$result = $api->invoiceGetAll($type, $query);
$totalCount = $result->{"Result"}->TotalCount;

if($totalCount % 10 != 0) {
$totalCount+=10;
if(isset($_POST["buttonSubmit"])) {
    for($j=0 ; $j<=(($totalCount)/10) ; $j++) {
        if (isset($_POST["buttonSubmit"][$j])) {
            $value = $_POST["buttonInput"][$j];
            $rpp = ($value * 10);
            $i = ($rpp - 10);
            $query = array(
                "SortBy" => "Date",
                "SortAsce" => true,
                "Take" => $rpp,
                "Skip" => $i
            );
            }
        }
    }
}

$result = $api->invoiceGetAll($type, $query);
$totalCount = $result->{"Result"}->TotalCount;
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

<?php if($totalCount) { ?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>
                دریافت لیست فاکتور
            </h3>
            <br>

            <table class="table table-2 table-striped table-hover">
                <th>ID</th>
                <th>شماره فاکتور</th>
                <th>شماره ارجاع</th>
                <th>تاریخ فاکتور</th>
                <th>جمع مبلغ فاکتور</th>
                <th>مبلغ قابل پرداخت فاکتور</th>
                <th>مبلغ پرداخت شده فاکتور</th>
                <th>مبلغ باقیمانده فاکتور</th>
                <th>نوع فاکتور</th>
                <th>هزینه حمل</th>
                <th>کد فروشنده</th>
                <th>درصد پورسانت فروشنده</th>
                <th>وضعیت فاکتور</th>
                <th>کد شخص</th>
                <th>عنوان شخص در فاکتور</th>
                <th>ایمیل</th>
                <th>وبسایت</th>
                <th>تلفن</th>
                <th>کدپستی</th>
            <?php
            $i = 0;
            $rpp = 10;
            foreach ($result->{'Result'}->{'List'} as $invoice) {
            if($i < $rpp) {
            ?>
                <tr>
                    <td><?php echo $invoice->{'Id'}; ?></td>
                    <td><?php echo $invoice->{'Number'}; ?></td>
                    <td><?php echo $invoice->{'Reference'}; ?></td>
                    <td><?php echo $invoice->{'Date'}; ?></td>
                    <td><?php echo $invoice->{'Sum'}; ?></td>
                    <td><?php echo $invoice->{'Payable'}; ?></td>
                    <td><?php echo $invoice->{'Paid'}; ?></td>
                    <td><?php echo $invoice->{'Rest'}; ?></td>
                    <td><?php echo $invoice->{'InvoiceType'}; ?></td>
                    <td><?php echo $invoice->{'Freight'}; ?></td>
                    <td><?php echo $invoice->{'SalesmanCode'}; ?></td>
                    <td><?php echo $invoice->{'SalesmanPercent'}; ?></td>
                    <td><?php echo $invoice->{'Status'}; ?></td>
                    <td><?php echo $invoice->{'ContactCode'}; ?></td>
                    <td><?php echo $invoice->{'Contact'}->{'Name'}; ?></td>
                    <td><?php echo $invoice->{'Contact'}->{'ContactEmail'}; ?></td>
                    <td><?php echo $invoice->{'Contact'}->{'Website'}; ?></td>
                    <td><?php echo $invoice->{'Contact'}->{'Phone'}; ?></td>
                    <td><?php echo $invoice->{'Contact'}->{'PostalCode'}; ?></td>
                </tr>

            <?php } $i++; } } else {echo "چیزی برای نمایش نیست" . "<br />" . "<br />";} ?>
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