<?php
error_reporting(0);
include "../API/class-api.php";
global $result;
$api = new Ssbhesabfa_Api();
    if(isset($_POST['SaveWarehouseReceipt'])) {
        $items = [];
        for($i = 1 ; $i <= $_POST["counter"] ; $i++) {
            $item = array(
                'ItemCode' => $_POST['ItemCode'.$i],
                'Quantity' => $_POST['Quantity'.$i],
                'Reference' => $_POST['Reference'.$i] ? : null,
                'Notes' => $_POST['Notes'.$i] ? : null
            );
            array_push($items, $item);
        }
        $receipt = array(
            'WarehouseCode' => $_POST['WarehouseCode'],
            'InvoiceNumber' => $_POST['InvoiceNumber'],
            'InvoiceType' => $_POST['InvoiceType'],
            'Date' => $_POST['Date'] ? : null,
            'Notes' => $_POST['Notes'] ? : null,
            'Freight' => $_POST['Freight'] ? : null,
            'Delivery' => $_POST['Delivery'] ? : null,
            'Project' => $_POST['Project'] ? : null,
            'Items' => $items
        );
        $deleteOldReceipts = $_POST['deleteOldReceipts'] ? : false;
        $result = $api->saveWarehouseReceipt($receipt, $deleteOldReceipts);
    }
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>ذخیره حواله انبار</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<script>
    var i = 2;
</script>
<?php
    if ($result->{"Success"}) {
        echo "<script>alert('حواله اضافه گردید')</script>";
    } else {
        include '../Errors/errorLog.php';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ذخیره حواله انبار
            </h3>
            <br>
            <div>
                <p class="text-danger bg-white p-2">
                    با فراخوانی این متد رسید یا حواله انبار برای فاکتور خرید یا فروش صادر می گردد. در صورتی که کالاهای فاکتور در چندین انبار مختلف وجود داشته باشند به ازای هر انبار باید یکبار این متد را فراخوانی کرد و در هر فراخوانی کالاها و تعداد مورد نیاز به تفکیک انبار ذکر گردد.
                    <br><br>
                    در صورتی که مقدار پارامتر deleteOldReceipts=true باشد، کلیه حواله های قبلی صادر شده برای فاکتور حذف خواهند شد و حواله جدید صادر می شود.
                    <br><br>
                    کلیه آیتم های باید از نوع کالا و با قابلیت کنترل موجودی باشند در غیر اینصورت حواله ثبت نخواهد شد.
                </p>
            </div>
            <form method="post" class="save-contact-form">
                <div class="halign">
                    <div class="align">
                        <label for="deleteOldReceipts" class="form-label">حذف رسید قدیم</label>
                        <select class="form-select" name="deleteOldReceipts" required>
                            <option selected>انتخاب کنید</option>
                            <option value="true">بله</option>
                            <option value="false">خیر</option>
                        </select>
                    </div>
                    <div class="align">
                        <label class="form-label" for="WarehouseCode">کد انبار</label>
                        <input class="form-control" type="text" name="WarehouseCode" required>
                    </div>
                    <div class="align">
                        <label class="form-label" for="InvoiceNumber">شماره فاکتور</label>
                        <input class="form-control" type="text" name="InvoiceNumber" required>
                    </div>
                    <div class="align">
                        <label for="InvoiceType" class="form-label">نوع فاکتور</label>
                        <select class="form-select" name="InvoiceType" required>
                            <option selected>انتخاب کنید</option>
                            <option value="0">فروش</option>
                            <option value="1">خرید</option>
                            <option value="2">برگشت از فروش</option>
                            <option value="3">برگشت از خرید</option>
                            <option value="4">ضایعات</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label class="form-label" for="Date">تاریخ حواله</label>
                        <input class="form-control" type="text" name="Date">
                    </div>
                    <div class="align">
                        <label class="form-label" for="Project">پروژه</label>
                        <input class="form-control" type="text" name="Project">
                    </div>
                    <div class="align">
                        <label class="form-label" for="Freight">هزینه حمل</label>
                        <input class="form-control" type="text" name="Freight">
                    </div>
                    <div class="align">
                        <label for="Notes" class="form-label">یادداشت و توضیحات</label>
                        <input class="form-control" name="Notes">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label for="Delivery" class="form-label">تحویل (در محل انبار)</label>
                        <input class="form-control" name="Delivery">
                    </div>
                </div>

                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>کد کالا</th>
                            <th>تعداد</th>
                            <th>ارجاع</th>
                            <th>توضیحات</th>
                        </tr>
                    </thead>
                    <tbody class="warehouse-tbody">
                        <tr>
                            <td><input class="form-control" name="ItemCode1" type="text" required><input type="hidden" value="1" name="counter"></td>
                            <td><input class="form-control" name="Quantity1" type="text" required></td>
                            <td><input class="form-control" name="Reference1" type="text"></td>
                            <td><input class="form-control" name="Notes1" type="text"></td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button id="deleteRow" class="deleteRow btn btn-danger m-2"><span class="m-2">-</span>حذف ردیف</button>
                    <button id="addNewRow" class="addNewRow btn btn-secondary m-2"><span class="m-2">+</span>افزودن ردیف</button>
                </div>
                <div class="button-container">
                    <button class="btn btn-primary" type="submit" name="SaveWarehouseReceipt">ذخیره حواله</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(() => {
        $("#addNewRow").on('click', (e) => {
            e.preventDefault();
            let element = `
                <tr id="element-${i}">

                    <td><input class="form-control" name="ItemCode${i}" type="text" required><input type="hidden" value="${i}" name="counter"></td>
                    <td><input class="form-control" name="Quantity${i}" type="text" required></td>
                    <td><input class="form-control" name="Reference${i}" type="text"></td>
                    <td><input class="form-control" name="Notes${i}" type="text"></td>
                </tr>`;
            ++i;
            $(".warehouse-tbody").append(element);
        });

        $("#deleteRow").on('click', (e) => {
            e.preventDefault();
            if(i>2) {
                $(`.warehouse-tbody`).children().last().remove();
                i--;
            }
        });
    });
</script>
</body>
</html>


