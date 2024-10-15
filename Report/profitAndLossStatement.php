<?php
error_reporting(0);
include "../API/class-api.php";
global $result;
$api = new Ssbhesabfa_Api();

if(isset($_POST["submitRequest"])) {
    $startDate = $_POST["startDate"] ? : null;
    $endDate = $_POST["endDate"] ? : null;
    $project = $_POST["project"] ? : null;

    $data = array(
        'startDate' => $startDate,
        'endDate' => $endDate,
        'project' => $project
    );
    $result = $api->reportProfitAndLossStatement($data);
} else {
    $data = array(
        'startDate' => null,
        'endDate' => null,
        'project' => null
    );
    $result = $api->reportProfitAndLossStatement($data);
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش صورت سود و زیان</title>
    <style>
        td {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<br>
<h3>
    گزارش صورت سود و زیان
</h3>
<br>
<form class="save-contact-form" method="post" style="direction: rtl;font-size: 0.9rem;">
    <div class="halign" style="padding: 0.5rem;">
        <div class="align">
            <label class="form-label" for="startDate">تاریخ شروع</label>
            <input class="form-control" type="text" name="startDate" placeholder="2023-03-26T00:00:00">
        </div>
        <div class="align">
            <label class="form-label" for="endDate">تاریخ پایان</label>
            <input class="form-control" type="text" name="endDate" placeholder="2024-03-25T00:00:00">
        </div>
        <div class="align">
            <label class="form-label" for="startDate">پروژه</label>
            <input class="form-control" type="text" name="project">
        </div>
    </div>
    <button name="submitRequest" class="btn btn-primary" type="submit">نمایش</button>
</form>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <?php if($result->{"Success"}) { ?>
            <table style="text-align: center;" class="table table-striped table-hover">
                <tr>
                    <th>حساب</th>
                    <th>
                        تراز
                    </th>
                </tr>
                <?php foreach ($result->{"Result"}->{"Accounts"} as $row) { ?>
                    <tr>
                        <td><?php echo($row->Account->Name);?></td>
                        <td style="<?php if($row->TotalBalance < 0) echo 'color:red;'; else echo 'color:green;';?>"><?php echo abs($row->TotalBalance);?></td>
                        <?php foreach ($row->Children as $subItem) {?>
                    </tr>

                        <tr>
                            <td style="color: #1C84C6;text-indent: 1.5rem;">
                                <?php echo($subItem->Account->Name);?>
                            </td>
                            <td style="<?php if($row->TotalBalance < 0) echo 'color:red;'; else echo 'color:green;';?>">
                                <?php echo abs($subItem->TotalBalance);?>
                            </td>
                        </tr>

                <?php } }?>
                    <tr>
                        <td><?php echo("موجودی کالا ابتدای دوره");?></td>
                        <td style="<?php if($result->{"Result"}->{"BeginningInventory"} < 0) echo 'color:red;'; else echo 'color:green;';?>"><?php echo($result->{"Result"}->{"BeginningInventory"});?></td>
                    </tr>
                    <tr>
                        <td><?php echo("موجودی کالا پایان دوره");?></td>
                        <td><?php echo($result->{"Result"}->{"EndingInventory"});?></td>
                    </tr>
                    <tr>
                        <td><?php echo($result->{"Result"}->{"InventoryAdjustment"}->{"Account"}->{"Name"});?></td>
                        <td><?php echo($result->{"Result"}->{"InventoryAdjustment"}->{"TotalBalance"}); ?></td>
                    </tr>
                    <tr style="<?php if($result->{"Result"}->{"ProfitOrLoss"} < 0) echo 'background:#EF5565;'; else echo 'background:#1AB394;';?>">
                        <td style="color:#f4f4f4 !important;">سود</td>
                        <td style="color:#f4f4f4 !important;"><?php echo abs($result->{"Result"}->{"ProfitOrLoss"}); ?></td>
                    </tr>
            </table>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
