<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $result;
if(isset($_POST["getContact"])) {
    $code = $_POST["code"];

    $result = $api->getContact($code);
    $contact = $result->{"Result"};
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
    <link rel="icon" href="../assets/hesabfaIcon.png">
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
            <h3>
                دریافت شخص
            </h3>
            <br>
        <form method="post" class="save-contact-form">
            <div class="align"><label for="code">کد شخص مورد نظر</label></div>
            <input type="text" name="code" />
            <button class="btn btn-primary" type="submit" name="getContact">دریافت شخص</button>
        </form>
            <br>
            <?php if(isset($contact)) {?>
            <div class="table table-responsive">
                <table class="table bigger-table table-striped table-hover">
                    <th>کد شخص</th>
                    <th>نام شخص</th>
                    <th>شرکت</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th><a href="https://hesabfa.com/help/api/TypesTable#contact-types">نوع شخص</a></th>
                    <th>کد/شناسه ملی</th>
                    <th>کد اقتصادی</th>
                    <th>شماره ثبت</th>
                    <th>آدرس شخص</th>
                    <th>شهر</th>
                    <th>استان</th>
                    <th>کد پستی</th>
                    <th>شماره تلفن</th>
                    <th>شماره فکس</th>
                    <th>شماره موبایل</th>
                    <th>ایمیل</th>
                    <th>وب سایت</th>
                    <th>تاریخ ثبت نام</th>
                    <th>یادداشت</th>
                    <th>درصد سهام</th>
                    <th>بدهکاری</th>
                    <th>بستانکاری</th>
                    <th>اعتبار مالی</th>
                    <th>Tag</th>
                    <th>وضعیت شخص</th>
                    <th><a href="https://hesabfa.com/help/api/TypesTable#tax-types-contact">نوع مالیات</a></th>
                    <th>دسته بندی شخص</th>

                    <tr>
                        <td><?php echo $contact->Code; ?></td>
                        <td><?php echo $contact->Name; ?></td>
                        <td><?php echo $contact->Company; ?></td>
                        <td><?php echo $contact->FirstName; ?></td>
                        <td><?php echo $contact->LastName; ?></td>
                        <td><?php echo $contact->ContactType; ?></td>
                        <td><?php echo $contact->NationalCode; ?></td>
                        <td><?php echo $contact->EconomicCode; ?></td>
                        <td><?php echo $contact->RegistrationNumber; ?></td>
                        <td><?php echo $contact->Address; ?></td>
                        <td><?php echo $contact->City; ?></td>
                        <td><?php echo $contact->State; ?></td>
                        <td><?php echo $contact->PostalCode; ?></td>
                        <td><?php echo $contact->Phone; ?></td>
                        <td><?php echo $contact->Fax; ?></td>
                        <td><?php echo $contact->Mobile; ?></td>
                        <td><?php echo $contact->Email; ?></td>
                        <td><?php echo $contact->Website; ?></td>
                        <td><?php echo $contact->RegistrationDate; ?></td>
                        <td><?php echo $contact->Note; ?></td>
                        <td><?php echo $contact->SharePercent; ?></td>
                        <td><?php echo $contact->Liability; ?></td>
                        <td><?php echo $contact->Credits; ?></td>
                        <td><?php echo $contact->ContactCredit; ?></td>
                        <td><?php echo $contact->Tag; ?></td>
                        <td><?php echo $contact->Active; ?></td>
                        <td><?php if($contact->TaxType) echo "فعال"; else "غیر فعال"; ?></td>
                        <td><?php echo $contact->NodeFamily; ?></td>

                    </tr>
                    <?php  }  else {echo "چیزی برای نمایش نیست";}?>
                </table>
            </div>
        </div></div></div>
</body>
</html>

