<?php
error_reporting(0);
include "../API/class-api.php";
global $result;
$api = new Ssbhesabfa_Api();
if(isset($_POST['WarehouseSaveWarehouseReceipt'])) {
    $items = [];
    for($i = 1 ; $i <= $_POST["counter"] ; $i++) {
        $item = array(
            'ItemCode' => $_POST['ItemCode'.$i],
            'Quantity' => (int)$_POST['Quantity'.$i],
        );

        if($_POST['Reference'.$i]) $item['Reference'] = $_POST['Reference'.$i];
        if($_POST['Notes'.$i]) $item['Notes'] = $_POST['Notes'.$i];

        array_push($items, $item);
    }
    $receipt = array(
        'WarehouseCode' => $_POST['WarehouseCode'],
        'InvoiceNumber' => $_POST['InvoiceNumber'],
        'InvoiceType' => $_POST['InvoiceType'],
        'DestinationWarehouseCode' => $_POST['DestinationWarehouseCode'],
        'Items' => $items
    );


    if($_POST['Date']) $receipt['Date'] = $_POST['Date'];
    if($_POST['Notes']) $receipt['Notes'] = $_POST['Notes'];
    if($_POST['Freight']) $receipt['Freight'] = $_POST['Freight'];
    if($_POST['Delivery']) $receipt['Delivery'] = $_POST['Delivery'];
    if($_POST['Project']) $receipt['Project'] = $_POST['Project'];


    $deleteOldReceipts = $_POST['deleteOldReceipts'];
    $result = $api->warehouseSaveWarehouse($deleteOldReceipts, $receipt);

    if ($result->Success) {
        $alertHTML = <<<'HTML'
        <div class="alert alert-success">
            <div>ذخیره گردید</div>
        </div>
        HTML;
    } else {
        $alertHTML = <<<HTML
            <div class="alert alert-danger">
                <div>خطا در عملیات ErrorCode: {$result->ErrorCode} - ErrorMessage: {$result->ErrorMessage}</div>
            </div>
        HTML;
    }
    echo '<script>
            document.getElementById("alert-container").innerHTML = `' . $alertHTML . '`;
        </script>';
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>ذخیره</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<script>
    var i = 2;
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ذخیره حواله انبار
            </h3>
            <br>
            <div id="alert-container"></div>
            <div class="alert alert-warning">
                <div>
                    با فراخوانی این متد رسید یا حواله انبار برای فاکتور خرید یا فروش صادر می گردد. در صورتی که کالاهای فاکتور در چندین انبار مختلف وجود داشته باشند به ازای هر انبار باید یکبار این متد را فراخوانی کرد و در هر فراخوانی کالاها و تعداد مورد نیاز به تفکیک انبار ذکر گردد.
                </div>
                <br>
                <div>
                    در صورتی که مقدار پارامتر deleteOldReceipts=true باشد، کلیه حواله های قبلی صادر شده برای فاکتور حذف خواهند شد و حواله جدید صادر می شود.
                </div>
                <br>
                <div>
                    کلیه آیتم های باید از نوع کالا و با قابلیت کنترل موجودی باشند در غیر اینصورت حواله ثبت نخواهد شد.
                </div>
                <br>
                <div>
                    در صورتی که فیلد DestinationWarehouseCode(کد حواله انتقال) دارای مقدار باشد، فیلدهای شماره و نوع فاکتور نادیده گرفته می شوند و حواله انتقال صادر خواهد شد.
                </div>
            </div>

            <form method="post" class="save-contact-form">
                <div class="halign">
                    <div class="align">
                        <label for="deleteOldReceipts" class="form-label">حذف رسید یا حواله قدیمی</label>
                        <select name="deleteOldReceipts" id="deleteOldReceipts" class="form-select">
                            <option value="false" selected>انتخاب کنید</option>
                            <option value="true">بله</option>
                            <option value="false">خیر</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="warehouseCode" class="form-label">کد انبار</label>
                        <input type="text" class="form-control" id="WarehouseCode" name="WarehouseCode">
                    </div>
                    <div class="align">
                        <label for="invoiceNumber" class="form-label">شماره فاکتور</label>
                        <input type="text" class="form-control" id="invoiceNumber" name="InvoiceNumber">
                    </div>
                    <div class="align">
                        <label for="invoiceType" class="form-label">نوع فاکتور</label>
                        <select id="invoiceType" name="InvoiceType" class="form-select">
                            <option value="-1" selected>انتخاب کنید</option>
                            <option value="0">فروش</option>
                            <option value="1">خرید</option>
                            <option value="2">برگشت از فروش</option>
                            <option value="3">برگشت از خرید</option>
                            <option value="4">ضایعات</option>
                        </select>
                    </div>
                </div>
                <div class="halign">
                    <div class="align">
                        <label for="date" class="form-label">تاریخ حواله</label>
                        <input type="text" class="form-control" id="date" name="Date">
                    </div>
                    <div class="align">
                        <label for="notes" class="form-label">یادداشت و توضیحات</label>
                        <input type="text" class="form-control" id="notes" name="Notes">
                    </div>
                    <div class="align">
                        <label for="freight" class="form-label">هزینه حمل</label>
                        <input type="text" class="form-control" id="freight" name="Freight">
                    </div>
                    <div class="align">
                        <label for="DestinationWarehouseCode" class="form-label">کد حواله انتقال</label>
                        <input type="text" class="form-control" id="DestinationWarehouseCode" name="DestinationWarehouseCode">
                    </div>
                </div>
                <div class="halign">
                    <div class="align">
                        <label for="delivery" class="form-label">تحویل (در محل انبار)</label>
                        <input type="text" class="form-control" id="delivery" name="Delivery">
                    </div>
                    <div class="align">
                        <label for="project" class="form-label">پروژه</label>
                        <input type="text" class="form-control" id="project" name="Project">
                    </div>
                </div>
                <br>
                <table class="table-striped table table-light">
                    <thead>
                    <tr>
                        <th>
                            کد کالا
                            <span style="color: red;font-size: 1.2rem;">*</span>
                        </th>
                        <th>
                            تعداد
                            <span style="color: red;font-size: 1.2rem;">*</span>
                        </th>
                        <th>
                            ارجاع
                        </th>
                        <th>
                            توضیحات
                        </th>
                    </tr>
                    </thead>
                    <tbody class="quantity-tbody">
                    <tr>
                        <td>
                            <input type="hidden" value="1" name="counter" class="counter">
                            <input class="accounting-input" type="text" name="ItemCode1" id="ItemCode1" required />
                        </td>
                        <td>
                            <input type="text" name="Quantity1" id="Quantity1" required />
                        </td>
                        <td>
                            <input type="text" name="Reference1" id="Reference1" />
                        </td>
                        <td>
                            <input type="text" name="Notes1" id="Notes1" />
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div id="buttons-container" style="justify-content: flex-end;">
                    <button id="deleteRow" class="deleteRow btn btn-danger m-2"><span class="m-2">-</span>حذف ردیف</button>
                    <button id="addNewRow" class="addNewRow btn btn-secondary m-2"><span class="m-2">+</span>افزودن ردیف</button>
                </div>
                <br>
                <button class="btn btn-success" name="WarehouseSaveWarehouseReceipt" type="submit">ذخیره</button>
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

                    <td><input type="text" name="ItemCode${i}" id="ItemCode${i}" class="accounting-input" required /><input type="hidden" value="${i}" name="counter" class="counter"></td>
                    <td><input type="text" name="Quantity${i}" id="Quantity${i}" required /></td>
                    <td><input type="text" name="Reference${i}" id="Reference${i}" /></td>
                    <td><input type="text" name="Notes${i}" id="Notes${i}" /></td>
                </tr>`;
            ++i;
            $(".quantity-tbody").append(element);
        });

        $("#deleteRow").on('click', (e) => {
            e.preventDefault();
            if(i>2) {
                $(`.quantity-tbody`).children().last().remove();
                i--;
            }
        });
    });
</script>
</body>
</html>
