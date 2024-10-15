<?php
    error_reporting(0);
    include './API/class-api.php';
    $api = new Ssbhesabfa_Api();
    $result = $api->getProjects();
    global $result;
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="CSS Files/style.css" />
    <?php include "./Bootstrap/SharedLinks.php";?>
    <script src="./assets/dx/dx.all.js"></script>
    <script src="./JS%20Files/app.js"></script>
    <link rel="icon" href="./assets/hesabfaIcon.png">
    <title>صفحه اصلی</title>
</head>
<body>
<div class="container-fluid">
    <?php include './Navbar Menu/indexNavbar.php'; ?>
</div>
<div id="render">
    <div class="row">
        <div class="container">
            <div class="col-12">
                <h3>
                    صفحه اصلی
                </h3>
                <br>
                <?php if($result->{"Success"}) { ?>
                    <table style="text-align: center;" class="table info-table table-striped table-hover">
                        <thead>
                        <th scope="row">نام کسب و کار</th>
                        <th scope="row">نام قانونی</th>
                        <th scope="row">تاریخ انقضاء</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td><p><?php echo $result->{'Result'}->Name;?></p></td>
                            <td><p><?php echo $result->{'Result'}->LegalName;?></p></td>
                            <td><p><?php echo (substr($result->{'Result'}->ExpireDate, 0, 10)); ?></p></td>
                        </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if(!$result->{"Success"}) { ?>
                    <div style="direction: rtl;background: #F8F9FA;color: #00AEEF;padding: 2rem;font-weight: bold;">
                        <h3>توجه</h3>
                        <p>برای ارتباط با نرم افزار باید API Key و Login Token را در فایل class-api.php وارد نمایید</p>
                    </div>
                <?php }?>
                <div class="index-description">
                    <div>
                        <h4 style="color: #6C757D;font-weight: bold;">مستندات رابط برنامه نویسی حسابفا</h4>
                        <br>
                        <p style="color:rgba(43,43,43,0.75);">
                            با کمک واسط برنامه نویسی حسابفا ، نرم افزار خود را به حسابداری ابری حسابفا متصل و مجهز کنید.
                            <br><br>
                            راهنمای واسطه برنامه نویسی و تمام اطلاعاتی که برای اتصال به حسابفا و بکارگیری API نیاز دارید را در اینجا مرور کنید.
                        </p>
                    </div>
                    <div>
                        <img src="./assets/feature.jpg" alt="feature">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

