<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

if(isset($_POST["getProductByBarcode"])) {
    $barcode = $_POST["barcode"];
    $data = array(
      'barcode' => $barcode
    );
    $result = $api->getItemByBarcode($data);
    $product = $result->{"Result"};
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>دریافت از طریق بارکد</title>
    <?php include "../Bootstrap/SharedLinks.php"; ?>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>دریافت کالا یا خدمات از طریق بارکد</h3>
            <br>
            <form method="post" class="get-product-form save-contact-form">
                <div class="align">
                    <label for="barcode">بارکد محصول مورد نظر</label>
                    <input type="text" name="barcode" />
                </div>
                <button class="btn btn-primary" type="submit" name="getProductByBarcode">دریافت</button>
            </form>
            <?php if(isset($product)) {?>
            <table class="table table-striped table-hover">
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
                <th>تگ</th>
                <th>توضیحات</th>
                <th>کد کالا یا خدمات</th>
                <th>وضعیت کالا</th>
                <tr>
                    <td><?php echo $product->Code;?></td>
                    <td><?php echo $product->Name;?></td>
                    <td style="direction: ltr;"><?php echo $product->Barcode;?></td>
                    <td><?php echo $product->ItemType;?></td>
                    <td><?php echo $product->Unit;?></td>
                    <td><?php echo $product->Stock;?></td>
                    <td><?php echo $product->BuyPrice;?></td>
                    <td><?php echo $product->SellPrice;?></td>
                    <td><?php echo $product->PurchasesTitle;?></td>
                    <td><?php echo $product->SalesTitle;?></td>
                    <td><?php echo $product->NodeFamily;?></td>
                    <td><?php echo $product->Tag;?></td>
                    <td><?php echo $product->Description;?></td>
                    <td><?php echo $product->ProductCode;?></td>
                    <td><?php if($product->Active) echo "فعال"; else echo "غیرفعال";?></td>
                </tr>
                <?php   }  else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
