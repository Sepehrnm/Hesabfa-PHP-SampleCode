<?php
error_reporting(0);
include '../API/class-api.php';
global $result;
$api = new Ssbhesabfa_Api();

if(isset($_POST["submitTrialBalanceItems"])) {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $project = $_POST["project"];
    $accountPath = $_POST["accountPath"];

    $data = array(
        'startDate' => $startDate ? : null,
        'endDate' => $endDate ? : null,
        'project' => $project ? : null,
        'accountPath' => $accountPath
    );
    $result = $api->reportTrialBalanceItems($data);
}

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش آیتم های تفضیلی تراز آزمایشی</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<br>
<h3>
    گزارش آیتم های تفضیلی تراز آزمایشی
</h3>
<br>
<form class="save-contact-form" method="post" style="direction: rtl;">
    <div class="halign" style="padding: 0.5rem;">
        <div class="align">
            <label class="form-label" for="startDate">تاریخ شروع</label>
            <input class="form-control" type="text" name="startDate" placeholder="(2023-03-26T00:00:00)">
        </div>

        <div class="align">
            <label class="form-label" for="endDate">تاریخ پایان</label>
            <input class="form-control" type="text" name="endDate" placeholder="(2024-03-25T00:00:00)">
        </div>

        <div class="align">
            <label class="form-label" for="project">پروژه</label>
            <input class="form-control" type="text" name="project">
        </div>

        <div class="align">
            <label class="form-label" for="accountPath">مسیر حساب</label>
            <input class="form-control" type="text" name="accountPath" required>
        </div>
    </div>
    <button name="submitTrialBalanceItems" class="btn btn-primary" type="submit">نمایش</button>
</form>
<?php if($result) { $items = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <?php if(isset($items)) { ?>
            <table class="table table-striped table-hover">
                <th>نام حساب</th>
                <th>مسیر حساب</th>
                <th>نوع حساب</th>
                <th>نوع حساب اصلی</th>
                <th>گردش بدهکار</th>
                <th>گردش بستانکار</th>
                <th>تراز حساب</th>
                <th>ماهیت حساب</th>
                <th>تراز افتتاحیه - بدهکار</th>
                <th>تراز افتتاحیه - بستانکار</th>
                <th>مانده از قبل - بدهکار</th>
                <th>مانده از قبل - بستانکار</th>

                <?php foreach ($items as $item) { ?>
                    <tr>
                        <td><?php echo $item->{"Account"}->Name; ?></td>
                        <td><?php echo $item->{"Account"}->Path; ?></td>
                        <td><?php echo $item->{"Account"}->AccountType; ?></td>
                        <td><?php echo $item->{"Account"}->MainAccountType; ?></td>
                        <td><?php echo $item->{"Debit"}; ?></td>
                        <td><?php echo $item->{"Credit"}; ?></td>
                        <td><?php echo $item->{"Balance"}; ?></td>
                        <td><?php echo $item->{"BalanceType"}; ?></td>
                        <td><?php echo $item->{"OpeningDebit"}; ?></td>
                        <td><?php echo $item->{"OpeningCredit"}; ?></td>
                        <td><?php echo $item->{"RemainingDebit"}; ?></td>
                        <td><?php echo $item->{"RemainingCredit"}; ?></td>

                    </tr>
                <?php   }  } else {echo "چیزی برای نمایش نیست";}?>
            </table>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>