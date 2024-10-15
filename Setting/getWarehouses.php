<?php
    error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    global $result;
    $result = $api->settingGetWarehouses();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست انبار ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست انبار ها
            </h3>
                <br>
        <?php if($result->{"Success"}) { $wareHouses = $result->{'Result'}; ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <th>ID انبار</th>
                    <th>نام انبار</th>
                    <th>کد انبار</th>
                    <?php foreach ($wareHouses as $wareHouse) { ?>
                        <tr>
                            <td><?php echo $wareHouse->Id; ?></td>
                            <td><?php echo $wareHouse->Name; ?></td>
                            <td><?php echo $wareHouse->Code; ?></td>
                        </tr>
                    <?php   }  } else {echo "چیزی برای نمایش نیست";}?>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>