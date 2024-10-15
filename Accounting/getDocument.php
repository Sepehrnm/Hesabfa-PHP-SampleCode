<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result, $document;
if(isset($_POST["getDocument"])) {
    $type = $_POST["type"];
    $number = $_POST["number"];

    $data = [
        "number" => $number
    ];

    $result = $api->getDocument($number);
    $document = $result->{"Result"};
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>دریافت</title>
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <style>
        .modal-header {
            justify-content: flex-end !important;
            gap: 0 1rem !important;
            flex-direction: row-reverse !important;
        }

        .modal-body div {
            height: 30px !important;
        }

        .modal-body h6 {
            margin: 1rem 0 !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت سند حسابداری
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align"><label for="number" class="form-label">شماره سند مورد نظر</label></div>
                <input type="text" name="number" class="form-control" />
                <button class="btn btn-primary" type="submit" name="getDocument">دریافت سند</button>
                <br><br>
            </form>
            <?php if(isset($document)) {?>
            <table class="table bigger-table table-striped table-hover">
                <th>ID</th>
                <th>شماره سند</th>
                <th>ارجاع</th>
                <th>تاریخ</th>
                <th>توضیحات</th>
                <th>پروژه</th>
                <th>بدهکار</th>
                <th>بستانکار</th>
                <th><a href="https://hesabfa.com/help/api/TypesTable#doc-status">وضعیت سند</a></th>
                <th>تراکنش های موجود در سند</th>

                <tr>
                    <td><?php echo $document->Id; ?></td>
                    <td><?php echo $document->Number; ?></td>
                    <td><?php echo $document->Reference; ?></td>
                    <td><?php echo $document->Date; ?></td>
                    <td><?php echo $document->Description; ?></td>
                    <td><?php echo $document->Project; ?></td>
                    <td><?php echo $document->Debit; ?></td>
                    <td><?php echo $document->Credit; ?></td>
                    <td><?php echo $document->Status; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">نمایش تراکنش ها</button>
                        <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تراکنش ها</h5>
                                        <button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&#10006;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <?php
                                        $i=1;
                                        foreach ($document->Transactions as $transaction) {
                                            echo "<h3 style='direction: ltr;'>" . $i . "  " . "تراکنش" . "</h3>";
                                            echo "<br />";
                                            echo "<div style='font-weight: bold;'>" . "واحد پول: " . $transaction->Currency . "&nbsp&nbsp&nbsp&nbsp" . "مبلغ در صورت چند ارزی بودن: " . $transaction->CurrencyAmount . "&nbsp&nbsp&nbsp&nbsp" . "مبلغ: " . $transaction->Amount . "&nbsp&nbsp&nbsp&nbsp" . "اطلاعات اضافه: " . $transaction->Info . "&nbsp&nbsp&nbsp&nbsp" . "حساب: " . $transaction->AccountPath . "</div>";
                                            echo "<div style='font-weight: bold;'>" . "نوع تراکنش: " . $transaction->Type . "&nbsp&nbsp&nbsp&nbsp" . "کد شخص: " . $transaction->ContactCode . "&nbsp&nbsp&nbsp&nbsp" . "کد کالا: " . $transaction->ProductCode . "&nbsp&nbsp&nbsp&nbsp" . "کد بانک: " . $transaction->BankCode . "&nbsp&nbsp&nbsp&nbsp" . "کد صندوق: " . $transaction->CashCode . "&nbsp&nbsp&nbsp&nbsp" . "کد تنخواه گردان: " . $transaction->PettyCashCode . "</div>";
                                            echo "<br />";
                                            $i++;
                                    }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php  }  else {echo "چیزی برای نمایش نیست";}?>
            </table>

        </div></div></div>
</body>
</html>

