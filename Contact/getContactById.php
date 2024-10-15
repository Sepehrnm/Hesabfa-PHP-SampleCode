<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();
global $totalCount, $result, $contact;

if(isset($_POST["getContactById"])) {
    $id = $_POST["id"];
    preg_match_all('!\d+!', $id, $matches);

    $result = $api->getContactById($matches[0]);
    $contact = $result->{"Result"};

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
    <title>دریافت از طریق ID</title>
    <?php include "../Bootstrap/SharedLinks.php"; ?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
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
                دریافت شخص از طریق ID
            </h3>
            <br>
        <form method="post" class="save-contact-form">
            <div class="align">
                <label for="id" class="form-label">کد شخص یا اشخاص مورد نظر</label>
                <input type="text" name="id" class="form-control" />
            </div>
            <button class="btn btn-primary" type="submit" name="getContactById">دریافت</button>
            <br><br>
        </form>
        <?php if(isset($contact) && count($contact) > 0) {?>
            <div class="table table-responsive">
            <table class="table bigger-table table-striped table-hover">
                <th>کد شخص</th>
                <th>نام شخص</th>
                <th>شرکت</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th><a href="https://hesabfa.com/help/api/TypesTable#contact-types">نوع</a></th>
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
                <th>وضعیت شخص</th>
                <th>
                    <a href="https://hesabfa.com/help/api/TypesTable#tax-types-contact">نوع مالیات</a>
                </th>
                <th>دسته بندی شخص</th>

                <?php for($j=0 ; $j<$totalCount ; $j++) { ?>
                <tr>
                    <td><?php echo $contact[$j]->Code; ?></td>
                    <td><?php echo $contact[$j]->Name; ?></td>
                    <td><?php echo $contact[$j]->Company; ?></td>
                    <td><?php echo $contact[$j]->FirstName; ?></td>
                    <td><?php echo $contact[$j]->LastName; ?></td>
                    <td><?php echo $contact[$j]->ContactType; ?></td>
                    <td><?php echo $contact[$j]->NationalCode; ?></td>
                    <td><?php echo $contact[$j]->EconomicCode; ?></td>
                    <td><?php echo $contact[$j]->RegistrationNumber; ?></td>
                    <td><?php echo $contact[$j]->Address; ?></td>
                    <td><?php echo $contact[$j]->City; ?></td>
                    <td><?php echo $contact[$j]->State; ?></td>
                    <td><?php echo $contact[$j]->PostalCode; ?></td>
                    <td><?php echo $contact[$j]->Phone; ?></td>
                    <td><?php echo $contact[$j]->Fax; ?></td>
                    <td><?php echo $contact[$j]->Mobile; ?></td>
                    <td><?php echo $contact[$j]->Email; ?></td>
                    <td><?php echo $contact[$j]->Website; ?></td>
                    <td><?php echo $contact[$j]->RegistrationDate; ?></td>
                    <td><?php echo $contact[$j]->Note; ?></td>
                    <td><?php echo $contact[$j]->SharePercent; ?></td>
                    <td><?php echo $contact[$j]->Liability; ?></td>
                    <td><?php echo $contact[$j]->Credits; ?></td>
                    <td><?php echo $contact[$j]->ContactCredit; ?></td>
                    <td><?php echo $contact[$j]->Active; ?></td>
                    <td><?php if($contact[$j]->TaxType) echo "فعال"; else "غیر فعال"; ?></td>
                    <td><?php echo $contact[$j]->NodeFamily; ?></td>

                </tr>
                <?php  } }  else {echo "چیزی برای نمایش نیست";}?>
            </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

