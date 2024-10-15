<?php
    error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result;

    if (isset($_POST["pay"])) {
        $invoiceItems = [];
        for ($i = 1; $i <= $_POST['counter']; $i++) {
            $invoiceItem =
                array(
                    "Description" => $_POST["Description" . $i],
                    "ItemCode" => $_POST["ItemCode" . $i],
                    "Quantity" => $_POST["Quantity" . $i],
                    "UnitPrice" => $_POST["Price" . $i],
                    "Discount" => $_POST["Discount" . $i],
                    "Tax" => $_POST["Tax" . $i],
                );
            array_push($invoiceItems, $invoiceItem);
        }

        $invoice = array(
            "Number" => $_POST["Number"],
            "Reference" => $_POST["Reference"],
            "Date" => $_POST["Date"],
            "DueDate" => $_POST["DueDate"],
            "ContactCode" => $_POST["ContactCode"],
            "InvoiceType" => $_POST["InvoiceType"],
            "Status" => $_POST["Status"],
            "InvoiceItems" => $invoiceItems,
        );

        if (isset($_POST["WarehouseReceiptStatus"])) {
            $invoice["WarehouseReceiptStatus"] = $_POST["WarehouseReceiptStatus"];
        }

        $result = $api->invoiceSave($invoice);
    }

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <title>ذخیره فاکتور</title>
    <?php include "../Bootstrap/SharedLinks.php";?>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
    if($result->{"Success"}) {
        echo '<script>alert("ثبت گردید")</script>';
    } else {
        include '../Errors/errorLog.php';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ذخیره فاکتور
            </h3>
            <br>
            <form class="save-contact-form save-invoice-form" method="post">
                <div class="halign">
                    <div class="align">
                        <label for="Number" class="form-label">شماره</label>
                        <input class="form-control" type="text" name="Number" />
                    </div>
                    <div class="align">
                        <label for="Reference" class="form-label">ارجاع</label>
                        <input class="form-control" type="text" name="Reference" />
                    </div>
                    <div class="align">
                        <label style="display: flex;align-items:center;gap: 0 2rem;max-height: 20px !important;" for="Date" class="form-label">
                            <span>تاریخ</span>
                            <button class="btn btn-secondary" id="todayBtn">امروز</button>
                        </label>
                        <input class="form-control" id="dateTime" type="text" name="Date" />
                    </div>
                    <div class="align">
                        <label style="display: flex;align-items:center;gap: 0 2rem;max-height: 20px !important;" for="DueDate" class="form-label">
                            <span>تاریخ سررسید</span>
                            <button class="btn btn-secondary" id="todayBtnDue">امروز</button>
                        </label>
                        <input class="form-control" id="dueDateTime" type="text" name="DueDate" />
                    </div>
                </div>
                <div class="halign" style="margin-top: 1rem;">
                    <div class="align">
                        <label for="ContactCode" class="form-label">کد مخاطب</label>
                        <input class="form-control" type="text" name="ContactCode" />
                    </div>
                    <div class="align">
                        <label for="Status" class="form-label">وضعیت فاکتور</label>
                        <select class="form-select" name="Status">
                            <option selected value="-1">انتخاب کنید</option>
                            <option value="0">پیش نویس</option>
                            <option value="1">تایید شده</option>
                        </select>
                    </div>

                    <div class="align">
                        <label for="InvoiceType" class="form-label">نوع فاکتور</label>
                        <select class="form-select" name="InvoiceType">
                            <option selected value="-1">انتخاب کنید</option>
                            <option value="0">فروش</option>
                            <option value="1">خرید</option>
                            <option value="2">برگشت از فروش</option>
                            <option value="3">برگشت از خرید</option>
                            <option value="4">ضایعات</option>
                        </select>
                    </div>

                    <div class="align">
                        <label for="WarehouseReceiptStatus" class="form-label">وضعیت رسید یا حواله انبار</label>
                        <select class="form-select" name="WarehouseReceiptStatus">
                            <option selected value="-1">انتخاب کنید</option>
                            <option value="0">رسید یا حواله انبار صادر نشده است</option>
                            <option value="1">رسید یا حواله انبار ناقص است</option>
                            <option value="2">رسید یا حواله انبار کامل است</option>
                        </select>
                    </div>
                </div>
                <br><br>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>کد حسابداری محصول</th>
                            <th>توضیحات محصول</th>
                            <th>تعداد</th>
                            <th>قیمت</th>
                            <th>تخفیف</th>
                            <th>مالیات</th>
                        </tr>
                    </thead>
                    <tbody class="invoice-tbody">
                        <tr id="element1">
                            <td><input class="form-control" type="text" name="ItemCode1" /><input type="hidden" name="counter" value="1" /></td>
                            <td><input class="form-control" type="text" name="Description1" /></td>
                            <td><input class="form-control" type="text" name="Quantity1" /></td>
                            <td><input class="form-control" type="text" name="Price1" /></td>
                            <td><input class="form-control" type="text" name="Discount1" /></td>
                            <td><input class="form-control" type="text" name="Tax1" /></td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button id="deleteRow" class="deleteRow btn btn-danger m-2"><span class="m-2">-</span>حذف ردیف</button>
                    <button id="addNewRow" class="addNewRow btn btn-secondary m-2"><span class="m-2">+</span>افزودن ردیف</button>
                </div>
                <div class="button-container">
                    <button type="submit" name="pay" class="btn btn-primary">ثبت فاکتور</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--jQuery-->
<script type="text/javascript">
    $(document).ready(() => {
        var i = 2;

        $("#addNewRow").on('click', (e) => {
            e.preventDefault();
            let element = `
                '<tr id="element${i}">
                    <td><input class="form-control" type="text" name="ItemCode${i}" /><input type="hidden" name="counter" value="${i}"></td>
                    <td><input class="form-control" type="text" name="Description${i}" /></td>
                    <td><input class="form-control" type="text" name="Quantity${i}" /></td>
                    <td><input class="form-control" type="text" name="Price${i}" /></td>
                    <td><input class="form-control" type="text" name="Discount${i}" /></td>
                    <td><input class="form-control" type="text" name="Tax${i}" /></td>
                </tr>`;
            i++;

            $(".invoice-tbody").append(element);
        });

        $("#deleteRow").on('click', (e) => {
            e.preventDefault();
            if(i>2) {
                $(`.invoice-tbody`).children().last().remove();
                i--;
            }
        });

        $("#todayBtn").on('click', (e) => {
            e.preventDefault();
            let options = { year: 'numeric', month: 'numeric', day: 'numeric' };
            let time = new Date();
            let minute = time.getMinutes();
            let hour = time.getHours();
            time =`${hour}:${minute}:00`;

            let date = new Date().toLocaleDateString("en-US", options);
            let month = date.split('/')[0];
            let day = date.split('/')[1];
            let year = date.split('/')[2];

            let dateTime = `${year}-${month}-${day} ${time}`;

            $("input#dateTime").val(dateTime);
        });

        $("#todayBtnDue").on('click', (e) => {
            e.preventDefault();
            let options = { year: 'numeric', month: 'numeric', day: 'numeric' };
            let time = new Date();
            let minute = time.getMinutes();
            let hour = time.getHours();
            time =`${hour}:${minute}:00`;

            let date = new Date().toLocaleDateString("en-US", options);
            let month = date.split('/')[0];
            let day = date.split('/')[1];
            let year = date.split('/')[2];

            let dateTime = `${year}-${month}-${day} ${time}`;

            $("input#dueDateTime").val(dateTime);
        });

    });
</script>
</body>
</html>