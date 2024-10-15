<?php
error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result;
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت فاکتور</title>
    <style>
        .modal-header {
            justify-content: flex-end !important;
            gap: 0 1rem !important;
            flex-direction: row-reverse !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت فاکتور
            </h3>
            <br>
            <form class="save-contact-form" method="post" style="direction: rtl;">
                <div class="align">
                    <label for="invoiceNumber">شماره فاکتور</label>
                    <input type="text" name="invoiceNumber">
                </div>
                <div class="align">
                    <label for="invoiceType" class="form-label">نوع فاکتور</label>
                    <select class="form-select" name="invoiceType">
                        <option selected>انتخاب کنید</option>
                        <option value="0">فروش</option>
                        <option value="1">خرید</option>
                        <option value="2">برگشت از فروش</option>
                        <option value="3">برگشت از خرید</option>
                        <option value="4">ضایعات</option>
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary" name="findInvoice">جستجو</button>
            </form>
            <br>
        <?php
        if(isset($_POST["findInvoice"])) {
            $invoice = array(
                'number'=> $_POST["invoiceNumber"],
                'type'=> $_POST["invoiceType"]
            );
            $result = $api -> invoiceGet($invoice);
            if($result->{'Result'}) { ?>
            <div class="table table-responsive">
            <table class="table table-striped table-hover">
                <th>ID</th>
                <th>شماره فاکتور</th>
                <th>شماره ارجاع</th>
                <th>تاریخ فاکتور</th>
                <th><a target="_blank" href="https://hesabfa.com/help/api/TypesTable#invoice-type">نوع فاکتور</a></th>
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
                    <td><?php echo $result->{'Result'}->{'InvoiceType'}; ?></td>
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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">نمایش جزییات</button>
                        <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">جزییات فاکتور</h5>
                                        <button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&#10006;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>کدحسابداری</th>
                                                <th>نام</th>
                                                <th>توضیحات</th>
                                            </tr>
                                    <?php
                                        foreach($result->{'Result'}->{'InvoiceItems'} as $item) {
                                    ?>
                                        <tbody class="table-light">
                                            <tr>
                                                <td><?php echo ($item->Item->Id);?></td>
                                                <td><?php echo ($item->Item->Code);?></td>
                                                <td><?php echo ($item->Item->Name);?></td>
                                                <td><?php echo ($item->Description);?></td>
                                            </tr>
                                        </tbody>
                                    <?php }?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>
       <?php } else {
            echo "جیزی برای نمایش نیست";
        }
    }
?>
<?php include '../Errors/errorLog.php'; ?>
</body>
</html>
