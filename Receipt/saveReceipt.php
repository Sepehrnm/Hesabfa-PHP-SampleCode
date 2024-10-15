<?php
error_reporting(0);
include '../API/class-api.php';
global $result;
$api = new Ssbhesabfa_Api();

if(isset($_POST["saveReceipt"])) {
    $data = array(
        "type" => (int)$_POST["type"],
        "number" => $_POST["number"] ? : null,
        "dateTime" => $_POST["DateTime"] ? : null,
        "project" => $_POST["project"] ? : null,
        "description" => $_POST["description"] ?: null,
        "bankCode" => $_POST["BankCode"],
        "contactCode" => $_POST["ContactCode"],
        "amount" => $_POST["Amount"],
        "bankFee" => $_POST["BankFee"] ? : null,
        "reference" => $_POST["Reference"] ? : null,
        "currency" => $_POST["Currency"] ? : null,
        "currencyRate" => $_POST["CurrencyRate"] ? : null,
        "cashCode" => $_POST["CashCode"] ? : null,
        "pettyCashCode" => $_POST["PettyCashCode"] ? : null,
    );

    $result = $api->saveReceipt($data);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ذخیره رسید</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <style>
        .save-receipt-form th, .save-receipt-form td {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
if(isset($result)) {
    if($result->{"Result"}) {
        echo "<script>alert('ثبت گردید')</script>";
    } else {
        include '../Errors/errorLog.php';
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ذخیره رسید
            </h3>
            <br>
            <div>
                <p class="text-danger"> در صورت عدم ارسال، رسید به تاریخ روز ذخیره می شود</p>
                <p class="text-danger">در صورت وجود، رسید ویرایش می شود. در صورتی که ارسال نشود، رسید جدید ذخیره خواهد شد</p>
            </div>
            <br><br>
            <form method="post" class="save-contact-form save-receipt-form">
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="type">نوع رسید</label>
                        <select class="form-select" name="type" required>
                            <option selected>انتخاب کنید</option>
                            <option value="1">دریافت</option>
                            <option value="2">پرداخت</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="number" class="form-label">شماره رسید مورد نظر</label>
                        <input class="form-control" type="text" name="number" />
                    </div>
                    <div class="align">
                        <label for="DateTime" class="form-label">تاریخ</label>
                        <input class="form-control" type="text" name="DateTime" />
                    </div>
                    <div class="align">
                        <label for="project" class="form-label">نام پروژه</label>
                        <input class="form-control" type="text" name="project" />
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="description" class="form-label">شرح رسید</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="align">
                        <label for="description" class="form-label">کد بانک</label>
                        <input type="text" class="form-control" name="BankCode" required>
                    </div>
                    <div class="align">
                        <label for="description" class="form-label">کد شخص</label>
                        <input type="text" class="form-control" name="ContactCode" required>
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="description" class="form-label">مبلغ به ارز پایه سیستم</label>
                        <input type="text" class="form-control" name="Amount" required>
                    </div>
                    <div class="align">
                        <label for="description" class="form-label">کارمزد خدمات بانکی</label>
                        <input type="text" class="form-control" name="BankFee">
                    </div>
                    <div class="align">
                        <label for="description" class="form-label">شماره ارجاع</label>
                        <input type="text" class="form-control" name="Reference">
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="Currency" class="form-label">واحد پول</label>
                        <input type="text" class="form-control" name="Currency">
                    </div>
                    <div class="align">
                        <label for="CurrencyRate" class="form-label">نرخ برابری ارز به ارز پایه</label>
                        <input type="text" class="form-control" name="CurrencyRate">
                    </div>
                    <div class="align">
                        <label for="CashCode" class="form-label">کد صندوق</label>
                        <input type="text" class="form-control" name="CashCode">
                    </div>
                    <div class="align">
                        <label for="CashCode" class="form-label">کد تنخواه گردان</label>
                        <input type="text" class="form-control" name="PettyCashCode">
                    </div>
                </div>
                <br>
                <button class="btn btn-primary" type="submit" name="saveReceipt">ذخیره رسید</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

