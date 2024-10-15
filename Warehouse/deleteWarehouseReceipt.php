<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>حذف</title>
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
               حذف حواله انبار
            </h3>
            <br>
            <div id="alert-container"></div>
            <form method="post" class="save-contact-form">
                <div class="align">
                    <label for="number" class="form-label">شماره رسید یا حواله مورد نظر</label>
                    <input type="text" class="form-control" name="number" id="number">
                </div>
                <button class="btn btn-danger" name="deleteWarehouseReceipt">حذف</button>
            </form>
        </div>
    </div>
</div>

<?php
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    if(isset($_POST["deleteWarehouseReceipt"])) {
        $data = array(
            "number" => $_POST["number"]
        );

        $result = $api->deleteWarehouse($data);
        if ($result->Success) {
            $alertHTML = <<<'HTML'
        <div class="alert alert-success">
            <div>حذف گردید</div>
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

</body>
</html>