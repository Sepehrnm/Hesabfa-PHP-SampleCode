<?php
error_reporting(0);
include "../API/class-api.php";
global $result;
$api = new Ssbhesabfa_Api();
if(isset($_POST['SavePayment'])) {
    $data = array(
        'type' => $_POST['type'],
        'number' => $_POST['number'],
        'bankCode' => $_POST['bankCode'] ? : null,
        'date' => $_POST['date'] ? : null,
        'amount' => $_POST['amount'] ? : null,
        'transactionNumber' => $_POST['transactionNumber'] ? : null,
        'description' => $_POST['description'] ? : null,
        'transactionFee' => $_POST['transactionFee'] ? : null,
        'currency' => $_POST['currency'] ? : null,
        'currencyRate' => $_POST['currencyRate'] ? : null,
        'cashCode' => $_POST['cashCode'] ? : null,
        'pettyCashCode' => $_POST['pettyCashCode'] ? : null,
    );

    $result = $api->savePayment($data);
}
?>


<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title> ثبت دریافت و پرداخت فاکتور</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
if ($result->{"Success"}) {
    echo "<script>alert('ثبت گردید')</script>";
} else {
    include '../Errors/errorLog.php';
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ثبت دریافت و پرداخت فاکتور
            </h3>
            <br>
            <div>
                <div class="text-danger p-2">
                    <span style="font-weight: bold;">نکات ضروری</span>
                    <br><br>
                    فقط یکی از سه فیلد bankCode، cashCode و pettyCashCode باید مقدار داشته باشد.
                    <br><br>
                    واحد پول فاکتور با واحد پول بانک، صندوق یا تنخواه گردان باید یکی باشد.
                    <br><br>
                    در صورت ذکر نشدن currency و currencyRate از مقادیر ذکر شده در فاکتور استفاده خواهد شد.
                </div>
                <div class="text-danger p-2">
                    <span style="font-weight: bold;">توضیحات فیلد transactionFee</span>
                    <br><br>
                    در صورتی که به ازای پرداخت آنلاین مبلغی بابت هزینه تراکنش از حساب شما کسر می شود این هزینه را
                    <br><br>
                    می توانید در این فیلد ثبت کنید تا سند هزینه به طور اتوماتیک صادر شود.
                </div>
            </div>
            <br>
            <form method="post" class="save-contact-form smaller-font-form">
                <div class="halign">
                    <div class="align">
                        <label for="type" class="form-label">نوع فاکتور</label>
                        <select class="form-select" name="type">
                            <option selected>انتخاب کنید</option>
                            <option value="0">فروش</option>
                            <option value="1">خرید</option>
                            <option value="2">برگشت از فروش</option>
                            <option value="3">برگشت از خرید</option>
                            <option value="4">ضایعات</option>
                        </select>
                    </div>
                    <br>
                    <div class="align">
                        <label class="form-label" for="number">شماره فاکتور فروش</label>
                        <input class="form-control" type="text" name="number" required>
                    </div>
                    <div class="align">
                        <label class="form-label" for="number">کد بانک</label>
                        <input class="form-control" type="text" name="bankCode">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="cashCode">کد صندوق</label>
                        <input class="form-control" type="text" name="cashCode">
                    </div>
                    <div class="align">
                        <label class="form-label" for="pettyCashCode">کد تنخواه گردان</label>
                        <input class="form-control" type="text" name="pettyCashCode">
                    </div>
                    <div class="align">
                        <label class="form-label" for="amount">مبلغ تراکنش</label>
                        <input class="form-control" type="text" name="amount">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="transactionNumber">شماره تراکنش</label>
                        <input type="text" name="transactionNumber">
                    </div>
                    <div class="align">
                        <label class="form-label" for="transactionFee">کارمزد تراکنش</label>
                        <input class="form-control" type="text" name="transactionFee">
                    </div>
                    <div class="align">
                        <label class="form-label" for="currency">واحد پول</label>
                        <input class="form-control" type="text" name="currency">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="currencyRate">نرخ برابری ارز</label>
                        <input class="form-control" type="text" name="currencyRate">
                    </div>
                    <div class="align">
                        <label class="form-label" for="description">توضیحات تراکنش</label>
                        <input class="form-control" type="text" name="description">
                    </div>
                    <div class="align">
                        <label class="form-label" for="date">تاریخ تراکنش</label>
                        <input class="form-control" type="text" name="date">
                    </div>
                </div>
                <br><br>
                <button class="btn btn-primary" type="submit" name="SavePayment">ثبت</button>
                <br><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>