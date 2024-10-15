<?php
    error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();

    global $totalCount, $result;
    $take = 10;
    $skip = 0;
    $query = array(
        "SortBy" => "Code",
        "SortAsec" => true,
        "Take" => 10,
        "Skip" => 0
    );
    $result = $api->itemsGet($query);
    $totalCount = ($result->{"Result"}->TotalCount);

    if($totalCount % 10 != 0) $totalCount += 10;
    if(isset($_POST["buttonSubmit"])) {
        for($j=0 ; $j<(($totalCount)/10) ; $j++) {
            if(isset($_POST["buttonSubmit"][$j])) {
                $value = $_POST["buttonInput"][$j];
                $rpp = ($value * 10);
                $i = ($rpp - 10);
                $query = array(
                    "SortBy" => "Code",
                    "SortAsec" => true,
                    "Take" => $rpp,
                    "Skip" => $i
                );
                $result = $api->itemsGet($query);
            }
        }
    }
$itemsArray = $result->{'Result'}->{'List'};

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست</title>
    <style>
        td, th {
            padding: 1rem !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <h3>دریافت لیست کالا یا خدمات</h3>
            <br>
            <table class="table table-striped table-hover">
                <th>آیدی</th>
                <th>کد حسابداری کالا یا خدمات</th>
                <th>نام کالا یا خدمات</th>
                <th>بارکد کالا یا خدمات</th>
                <th><a target="_blank" href="https://hesabfa.com/help/api/TypesTable#item-type">نوع</a></th>
                <th>واحد خرید و فروش</th>
                <th>موجودی</th>
                <th>قیمت خرید</th>
                <th>قیمت فروش</th>
                <th>عنوان در فاکتور فروش</th>
                <th>عنوان در فاکتور خرید</th>
                <th>مسیر دسته بندی</th>
                <th>توضیحات</th>
                <th>کد کالا یا خدمات</th>
                <th>وضعیت کالا</th>
                <?php
                $i = 0;
                $rpp = 10;
                foreach ($itemsArray as $item) {
                if($i < $rpp) {?>
                    <form action="#" method="post">
                        <tr>
                            <td><?php echo $item->Id; ?></td>
                            <td><?php echo $item->Code; ?></td>
                            <td><?php echo $item->Name; ?></td>
                            <td style="direction: ltr;"><?php echo $item->Barcode;?></td>
                            <td><?php echo $item->ItemType;?></td>
                            <td><?php echo $item->Unit;?></td>
                            <td><?php echo $item->Stock; ?></td>
                            <td><?php echo $item->BuyPrice;?></td>
                            <td><?php echo $item->SellPrice; ?></td>
                            <td><?php echo $item->PurchasesTitle; ?></td>
                            <td><?php echo $item->SalesTitle; ?></td>
                            <td><?php echo $item->NodeFamily;?></td>
                            <td><?php echo $item->Description;?></td>
                            <td><?php echo $item->ProductCode;?></td>
                            <td><?php if($item->Active) echo "فعال"; else echo "غیرفعال";?></td>
                        </tr>
                    </form>
                <?php } $i++; } ?>
            </table>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?>
                            <input name="buttonInput[<?php echo $z;?>]" type="hidden" value="<?php echo $z;?>" />
                        </button>
                    <?php  } ?>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>