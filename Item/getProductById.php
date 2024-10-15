<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $totalCount, $result;

if(isset($_POST["getProductById"])) {
    $id = $_POST["id"];
    preg_match_all('!\d+!', $id, $matches);

    $result = $api->getItemById($matches[0]);
    $product = $result->{"Result"};
    $totalCount = count($result->{"Result"});
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS%20Files/style.css">
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت از طریق Id</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>دریافت کالا یا خدمات از طریق ID</h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label class="form-label" for="id">ID محصول یا محصولات مورد نظر</label>
                    <input class="form-control" type="text" name="id" />
                </div>
                <button class="btn btn-primary" type="submit" name="getProductById">دریافت</button>
            </form>
            <br>
            <?php if(isset($product)) {?>
            <table class="table bigger-table table-striped table-hover">
                <th>کد حسابداری کالا یا خدمات</th>
                <th>نام کالا یا خدمات</th>
                <th>بارکد کالا یا خدمات</th>
                <th><a href="https://hesabfa.com/help/api/TypesTable#item-type">نوع</a></th>
                <th>واحد خرید و فروش</th>
                <th>موجودی</th>
                <th>قیمت خرید</th>
                <th>قیمت فروش</th>
                <th>عنوان در فاکتور فروش</th>
                <th>عنوان در فاکتور خرید</th>
                <th>مسیر دسته بندی</th>
                <th>Tag</th>
                <th>توضیحات</th>
                <th>کد کالا یا خدمات</th>
                <th>وضعیت کالا</th>

                <?php for($j=0 ; $j<$totalCount ; $j++) { ?>
                    <tr>
                        <td><?php echo $product[$j]->Code;?></td>
                        <td><?php echo $product[$j]->Name;?></td>
                        <td><?php echo $product[$j]->Barcode;?></td>
                        <td><?php echo $product[$j]->ItemType;?></td>
                        <td><?php echo $product[$j]->Unit;?></td>
                        <td><?php echo $product[$j]->Stock;?></td>
                        <td><?php echo $product[$j]->BuyPrice;?></td>
                        <td><?php echo $product[$j]->SellPrice;?></td>
                        <td><?php echo $product[$j]->PurchasesTitle;?></td>
                        <td><?php echo $product[$j]->SalesTitle;?></td>
                        <td><?php echo $product[$j]->NodeFamily;?></td>
                        <td><?php echo $product[$j]->Tag;?></td>
                        <td><?php echo $product[$j]->Description;?></td>
                        <td><?php echo $product[$j]->ProductCode;?></td>
                        <td><?php if($product[$j]->Active) echo "فعال"; else echo "غیرفعال";?></td>


                    </tr>
                <?php  } }  else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

