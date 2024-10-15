<?php
    error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result;

    if(isset($_POST["getInvoiceLink"])) {
        $data = array(
            'number'=> $_POST["number"],
            'type'=> $_POST["type"]
        );

        $result = $api->getOnlineInvoiceUrl($data);
        $invoiceLink = $result->{"Result"};
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت URL فاکتور آنلاین</title>
    <?php include "../Bootstrap/SharedLinks.php"; ?>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت URL فاکتور آنلاین
            </h3>
            <br>
            <div>
                <p class="text-danger bg-white p-2">
                    این متد در حال حاظر صرفا برای فاکتورهای فروش فعال است.
                    <br>
                    <br>
                    در صورتی که درگاه پرداختی اینترنتی فعال نشده باشد، امکان دریافت URL فاکتور آنلاین وجود ندارد.
                    <br>
                    <br>
                    برای فعالسازی درگاه پرداختی اینترنتی از منوی تنظیمات، تنظیمات فاکتور آنلاین را انتخاب کنید.
                </p>
            </div>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label for="number">شماره فاکتور مورد نظر</label>
                    <input type="text" name="number" required />
                </div>
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
                <button class="btn btn-primary" type="submit" name="getInvoiceLink">دریافت</button>
            </form>
            <?php if(isset($invoiceLink)) {?>
            <table class="table bigger-table table-striped table-hover">
                <th style="text-align: center;">لینک فاکتور آنلاین</th>
                <tr>
                    <td style="text-align: center;"><?php echo $invoiceLink; ?></td>
                </tr>
                <?php  }  else {echo "چیزی برای نمایش نیست";}?>
            </table>

        </div>
    </div>
</div>
</body>
</html>


