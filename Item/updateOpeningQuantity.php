<?php
error_reporting(0);
global $result;
include "../API/class-api.php";
$api = new Ssbhesabfa_Api();

if(isset($_POST["updateQuantity"])) {
    $items = [];
    for($i = 1 ; $i <= $_POST['counter'] ; $i++) {
        if(($_POST['WarehouseCode'.$i])) {
            $items = array(array(
                'Code' => $_POST['Code'.$i],
                'Quantity' => $_POST['Quantity'.$i],
                'UnitPrice' => $_POST['UnitPrice'.$i],
                'WarehouseCode' => $_POST['WarehouseCode'.$i]
            ));
        } else {
            $items = array(array(
                'Code' => $_POST['Code'.$i],
                'Quantity' => $_POST['Quantity'.$i],
                'UnitPrice' => $_POST['UnitPrice'.$i],
            ));
        }
    }
    $result = $api->UpdateOpeningQuantity($items);
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>به روز رسانی موجودی اول دوره کالاها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<script>
    var i = 2;
</script>
<?php
    if($result->{"Success"}) {
        echo "<script>alert('بروزرسانی گردید')</script>";
    } else {
        include '../Errors/errorLog.php';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>به روز رسانی موجودی اول دوره کالاها</h3>
            <br>
            <p class="color-danger bg-white p-2">
                با فراخوانی این متد موجودی اول دوره کالاها در تراز افتتاحیه ثبت خواهد شد. همچنین سند افتتاحیه به تناسب اطلاعات ویرایش خواهد شد. بنابراین پیش از فراخوانی این متد مطمئن باشید که سهامداران در سیستم تعریف شده باشند.
                <br>
                این عمل فقط در اولین سال مالی امکان پذیر است.
                <br>
                فقط موجودی کالاهایی که ارسال می شوند به روز خواهند شد و موجودی سایر کالاهایی که هم اکنون در تراز افتتاحیه ثبت شده اند تغییری نخواهند کرد.
                <br>
                تعداد و قیمت واحد باید بزرگتر از صفر باشند. در غیر اینصورت ثبت نخواهند شد.
                <br>
                دقت شود که این متد فقط در شروع سال مالی فراخوانی شود. فراخوانی این متد در اواسط سال مالی ممکن است باعث بروز اختلال در موجودی سیستم شود.
            </p>
        <form action="#" method="post" class="save-contact-form extra-save-style">
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
                            مبلغ واحد
                            <span style="color: red;font-size: 1.2rem;">*</span>
                        </th>
                        <th>
                            کد انبار
                        </th>
                    </tr>
                </thead>
                <tbody class="quantity-tbody">
                    <tr>
                        <td>
                            <input type="hidden" value="1" name="counter">
                            <input class="accounting-input" type="text" name="Code1" required />
                        </td>
                        <td>
                            <input type="text" name="Quantity1" required />
                        </td>
                        <td>
                            <input type="text" name="UnitPrice1" required />
                        </td>
                        <td>
                            <input type="text" name="WarehouseCode1" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button id="deleteRow" class="deleteRow btn btn-danger m-2"><span class="m-2">-</span>حذف ردیف</button>
                <button id="addNewRow" class="addNewRow btn btn-secondary m-2"><span class="m-2">+</span>افزودن ردیف</button>
            </div>
            <div class="button-container">
                <button class="btn btn-primary" name="updateQuantity" type="submit">ذخیره</button>
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
                    <input type="hidden" value="${i}" name="counter">
                    <td><input class="accounting-input" type="text" name="Code${i}" required /></td>
                    <td><input type="text" name="Quantity${i}" required /></td>
                    <td><input type="text" name="UnitPrice${i}" required /></td>
                    <td><input type="text" name="WarehouseCode${i}" /></td>
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


