<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result, $debit, $credit;

if(isset($_POST["submitDocument"])) {
    $Transactions = [];
    for($i = 1 ; $i <= $_POST['counter'] ; $i++) {
        $Transaction = array(
            'AccountPath' => $_POST['AccountPath'.$i] ? : null,
            'Type' => 0,
            'Description' => $_POST['Description'.$i] ? : null,
        );
        array_push($Transactions, $Transaction);
        $credit .= $_POST['Credit'.$i];
        $debit .= $_POST['Debit'.$i];
    }

    $document = array(
        'Description' => $_POST['Description'] ? : null,
        'Number' => $_POST['Number'],
        'Reference' => $_POST['Reference'] ? : null,
        'Date' => $_POST['Date'] ? : null,
        "Debit" => $debit,
        "Credit" => $credit,
        'Project' => $_POST['Project'] ? : null,
        'Status' => $_POST['Status'] ? : null,
        'Transactions' => $Transactions
    );

    $result = $api->saveDocument($document);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ذخیره</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <style>
        .text-container li {
            background: transparent !important;
            color: #d33838;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php
if(isset($result)) {
    if($result->{"Success"}) {
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
                ذخیره سند حسابداری
            </h3>
            <br>
            <div class="text-container">
                <p class="text-danger fw-bold">نکات ضروری</p>
                <p class="text-danger">1- اگر شماره سند ذکر شود، سند انتخاب شده ویرایش خواهد شد. توجه کنید که تنها اسناد دستی قابل ذخیره و ویرایش هستند.</p>
                <p class="text-danger">2- در صورتی که تفصیل حساب انتخاب شده شخص باشد فیلد کد شخص، اگر کالا باشد فیلد کد کلا، اگر بانک باشد فیلد کد بانک، اگر صندوق باشد فیلد کد صندوق و اگر تنخواه گردان باشد فیلد کد تنخواه گردان برای هر تراکنش باید پر باشد.</p>
                <p class="text-danger">3-  بدیهی است که سایر کدها برای آن تراکنش باید خالی باشند.</p>
                <p class="text-danger">4- برای ثبت تراکنش ارزی، در فیلد CurrencyAmount مبلغ ارزی تراکنش و در فیلد Amount مبلغ تراکنش به ارز پایه سیستم باید ثبت شود.</p>
                <p class="text-danger">5- حداقل دو تراکنش باید در سند ثبت شود. اگر وضعیت سند را تایید شده انتخاب کنید، سند حتما باید تراز باشد.</p>
            </div>
            <form method="post" class="save-document-form save-contact-form">
            <?php
                $currentDate = date('20y-m-d');
            ?>
                <div class="halign">
                    <div class="align">
                        <label for="Number" class="form-label">شماره</label>
                        <input type="text" name="Number" class="form-control">
                    </div>
                    <div class="align">
                        <label for="Reference" class="form-label">ارجاع</label>
                        <input type="text" name="Reference" class="form-control">
                    </div>
                    <div class="align">
                        <label for="Date" class="form-label">تاریخ</label>
                        <input type="text" name="Date" class="form-control" placeholder="<?php echo $currentDate;?>">
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="Project" class="form-label">پروژه</label>
                        <input type="text" name="Project" class="form-control">
                    </div>
                    <div class="align">
                        <label for="Description" class="form-label">شرح</label>
                        <input type="text" name="Description" class="form-control">
                    </div>
                    <div class="align">
                        <label for="Status" class="form-label">وضعیت سند</label>
                        <select class="form-select" name="Status">
                            <option selected>انتخاب کنید</option>
                            <option value="0">پیش نویس</option>
                            <option value="1">تایید شده</option>
                        </select>
                    </div>
                </div>
                <br><br>

                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>حساب</th>
                            <th>بدهکار</th>
                            <th>بستانکار</th>
                        </tr>
                    </thead>
                    <tbody class="invoice-tbody">
                        <tr id="element1">
                            <td><input type="text" name="AccountPath1" class="form-control" value="بدهی ها : بدهیهای جاری : پیش دریافت ها : پیش دریافت فروش"><input type="hidden" value="1" name="counter"></td>
                            <td><input type="text" name="Debit1" class="form-control"></td>
                            <td><input type="text" name="Credit1" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button id="deleteRow" class="deleteRow btn btn-danger m-2"><span class="m-2">-</span>حذف ردیف</button>
                    <button id="addNewRow" class="addNewRow btn btn-secondary m-2"><span class="m-2">+</span>افزودن ردیف</button>
                </div>
                <div class="button-container">
                    <button type="submit" name="submitDocument" class="btn btn-primary">ذخیره سند</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(() => {
        var i = 2;
        $("#addNewRow").on('click', (e) => {
            e.preventDefault();
            let element = `
                '<tr id="element${i}">
                    <td><input type="text" name="AccountPath${i}" class="form-control" value="بدهی ها : بدهیهای جاری : پیش دریافت ها : پیش دریافت فروش"><input type="hidden" value="${i}" name="counter"></td>
                    <td><input type="text" name="Debit${i}" class="form-control"></td>
                    <td><input type="text" name="Credit${i}" class="form-control"></td>
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
    });
</script>
</body>
</html>