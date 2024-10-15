<?php
error_reporting(0);

include "../API/class-api.php";
$api = new Ssbhesabfa_Api();
global $result;

if(isset($_POST["saveProduct"])) {
    $product = array(
        "Code" => $_POST["Code"] ? : null,
        "Name" => $_POST["Name"] ? : null,
        "ItemType" => $_POST["ItemType"] ? : null,
        "Barcode" => $_POST["Barcode"] ? : null,
        "Unit" => $_POST["Unit"] ? : null,
        "BuyPrice" => $_POST["BuyPrice"] ? : null,
        "SellPrice" => $_POST["SellPrice"] ? : null,
        "PurchasesTitle" => $_POST["PurchasesTitle"] ? : null,
        "SalesTitle" => $_POST["SalesTitle"] ? : null,
        "Description" => $_POST["Description"] ? : null,
        "ProductCode" => $_POST["ProductCode"] ? : null,
        "Active" => $_POST["Active"] ? : null,
        "NodeFamily" => $_POST["NodeFamily"] ? : null,
    );

    $result = $api->saveItem($product);
}
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>ذخیره</title>
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
<?php include '../Errors/errorLog.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>ذخیره کالا یا خدمات</h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="contact-image-container">
                    <img src="../assets/product.jpg" alt="product">
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label for="Code" class="form-label">کد حسابداری</label>
                        <input class="form-control" type="text" name="Code" />
                    </div>
                    <div class="align">
                        <label for="Name" class="form-label">نام کالا</label>
                        <input class="form-control" type="text" name="Name" required />
                    </div>
                    <div class="align">
                        <label class="form-label" for="Barcode">بارکد کالا/خدمات</label>
                        <input type="text" class="form-control" name="Barcode">
                    </div>
                    <div class="align">
                        <label for="inputState" class="form-label">نوع</label>
                        <select class="form-select" name="ItemType">
                            <option selected>انتخاب کنید</option>
                            <option value="0">کالا</option>
                            <option value="1">خدمات</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label for="Unit" class="form-label">واحد کالا</label>
                        <input class="form-control" type="text" name="Unit" />
                    </div>
                    <div class="align">
                        <label for="BuyPrice" class="form-label">قیمت خرید</label>
                        <input class="form-control" type="text" name="BuyPrice" required />
                    </div>
                    <div class="align">
                        <label class="form-label" for="SellPrice">قیمت فروش</label>
                        <input type="text" class="form-control" name="SellPrice">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label for="PurchasesTitle" class="form-label">عنوان در فاکتور فروش</label>
                        <input class="form-control" type="text" name="PurchasesTitle" />
                    </div>
                    <div class="align">
                        <label for="SalesTitle" class="form-label">عنوان در فاکتور خرید</label>
                        <input class="form-control" type="text" name="SalesTitle" required />
                    </div>
                    <div class="align">
                        <label class="form-label" for="Description">توضیحات</label>
                        <input type="text" class="form-control" name="Description">
                    </div>
                </div>
                <br>
                <div class="halign">
                    <div class="align">
                        <label for="ProductCode" class="form-label">کد کالا یا خدمات</label>
                        <input class="form-control" type="text" name="ProductCode" />
                    </div>
                    <div class="align">
                        <label for="Active" class="form-label">وضعیت کالا</label>
                        <input class="form-control" type="text" name="Active" required />
                    </div>
                    <div class="align">
                        <label class="form-label" for="NodeFamily">دسته بندی کالا</label>
                        <input type="text" class="form-control" name="NodeFamily">
                    </div>
                </div>
                <br>
                <button class="btn btn-primary" name="saveProduct" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>


