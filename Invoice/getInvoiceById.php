<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;
if(isset($_POST["findInvoiceById"])) {
$result = $api -> invoiceGetById((int)$_POST["invoiceID"]);
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت از طریق Id</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>

<div class="container">
    <div class="row">
        <div col="12">
            <h3 style="margin: 1rem 0;">
                دریافت فاکتور از طریق ID
            </h3>
            <br>
            <form class="save-contact-form" method="post" style="direction: rtl;padding: 1rem 0;">
                <div class="align">
                    <label for="invoiceID">ID صورتحساب</label>
                    <input style="width: 100%;" type="text" name="invoiceID">
                </div>
                <button type="submit" class="btn btn-primary" name="findInvoiceById">جستجو</button>
            </form>
            <br><br>
        <?php
            if($result->{'Result'}) { ?>
            <div class="table table-responsive">
            <table class="table table-striped table-hover">
                <th>ID</th>
                <th>شماره فاکتور</th>
                <th>شماره ارجاع</th>
                <th>تاریخ فاکتور</th>
                <th>کد شخص</th>
                <th>نام شخص</th>
                <th>ایمیل</th>
                <th>وبسایت</th>
                <th>موبایل</th>
                <th>کدپستی</th>
                <th>جمع مبلغ فاکتور</th>
                <th>مبلغ قابل پرداخت فاکتور</th>
                <th>مبلغ پرداخت شده فاکتور</th>
                <th>مبلغ باقیمانده فاکتور</th>
                <th>پروژه</th>
                <th>کد فروشنده</th>
                <th>واحد پولی</th>
                <th>شرح کالا</th>

                <tr>
                    <td><?php echo $result->{'Result'}->{'Id'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Number'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Reference'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Date'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'ContactCode'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Contact'}->{'FirstName'} . "  " . $result->{'Result'}->{'Contact'}->{'LastName'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Contact'}->{'ContactEmail'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Contact'}->{'Website'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Contact'}->{'Phone'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Contact'}->{'PostalCode'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Sum'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Payable'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Paid'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Rest'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Project'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'SalesmanCode'}; ?></td>
                    <td><?php echo $result->{'Result'}->{'Currency'};; ?></td>
                    <td>
                        <?php
                        foreach($result->{'Result'}->{'InvoiceItems'} as $item) { ?>
                            <div style="border-bottom: 1px solid #ccc;padding: 0.5rem;"><?php echo($item->Description); ?></div>
                        <?php }?>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>

    <?php } else {
        echo "چیزی برای نمایش نیست";
    }
?>
</body>
</html>

