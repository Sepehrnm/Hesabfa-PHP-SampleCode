<?php
    include "../API/class-api.php";
    $api = new Ssbhesabfa_Api();

    if(isset($_POST["saveContact"])) {
        $contact = array(
            "Code" => $_POST["Code"],
            "Name" => $_POST["Name"],
            "FirstName" => $_POST["FirstName"],
            "LastName" => $_POST["LastName"],
            "ContactType" => $_POST["ContactType"],
            "NationalCode" => $_POST["NationalCode"],
            "Company" => $_POST["Company"],
            "EconomicCode" => $_POST["EconomicCode"],
            "Website" => $_POST["Website"],
            "ContactEmail" => $_POST["ContactEmail"],
            "RegistrationNumber" => $_POST["RegistrationNumber"],
            "Address" => $_POST["Address"],
            "City" => $_POST["City"],
            "State" => $_POST["State"],
            "PostalCode" => $_POST["PostalCode"],
            "Phone" => $_POST["Phone"],
            "Fax" => $_POST["Fax"],
            "Mobile" => $_POST["Mobile"],
            "ContactCredit" => $_POST["ContactCredit"],
            "TaxType" => $_POST["TaxType"],
            "Active" => $_POST["Active"],
        );
        $result = $api->saveContact($contact);
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
<?php include '../Errors/errorLog.php';?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                ذخیره شخص
            </h3>
            <br>
            <form method="post" class="save-contact-form">
                <div class="contact-image-container">
                    <img src="../assets/contact.jpg" alt="contact">
                </div>
                <br><br>
                <div class="halign">
                    <div class="align">
                        <label for="Code" class="form-label">کد شخص</label>
                        <input title="در صورتی که کد شخص را وارد نکنید، شخص جدید ذخیره می شود.در صورتی که کد وارد شود و موجود باشد، اطلاعات ویرایش می شود.در صورتی که کد وارد شود و موجود نباشد، شخص با آن کد ذخیره خواهد شد" class="form-control" type="text" name="Code" />
                    </div>
                    <div class="align">
                        <label for="Company" class="form-label">شرکت</label>
                        <input class="form-control" type="text" name="Company" />
                    </div>
                    <div class="align">
                        <label for="FirstName" class="form-label">نام</label>
                        <input class="form-control" type="text" name="FirstName" />
                    </div>
                    <div class="align">
                        <label for="LastName" class="form-label">نام خانوادگی</label>
                        <input class="form-control" type="text" name="LastName" />
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="ContactType" class="form-label">نوع شخص</label>
                        <select class="form-select" name="ContactType" required>
                            <option selected>انتخاب کنید</option>
                            <option value="0">نامشخص</option>
                            <option value="1">حقیقی</option>
                            <option value="2">حقوقی</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="Name" class="form-label">نام شخص</label>
                        <input class="form-control" type="text" name="Name" />
                    </div>
                    <div class="align">
                        <label for="NationalCode" class="form-label">کد ملی</label>
                        <input class="form-control" type="text" name="NationalCode" maxlength="10" required />
                    </div>
                    <div class="align">
                        <label for="EconomicCode" class="form-label">کد اقتصادی</label>
                        <input class="form-control" type="text" name="EconomicCode" />
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="Website" class="form-label">وبسایت</label>
                        <input class="form-control" type="text" name="Website" />
                    </div>
                    <div class="align">
                        <label for="ContactEmail" class="form-label">ایمیل</label>
                        <input class="form-control" type="text" name="ContactEmail" />
                    </div>
                    <div class="align">
                        <label for="RegistrationNumber" class="form-label">شماره ثبت</label>
                        <input class="form-control" type="text" name="RegistrationNumber" />
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="Address" class="form-label">آدرس</label>
                        <input class="form-control" type="text" name="Address" />
                    </div>
                    <div class="align">
                        <label for="State" class="form-label">استان</label>
                        <input class="form-control" type="text" name="State" />
                    </div>
                    <div class="align">
                        <label for="City" class="form-label">شهر</label>
                        <input class="form-control" type="text" name="City" />
                    </div>
                    <div class="align">
                        <label for="PostalCode" class="form-label">کد پستی</label>
                        <input class="form-control" type="text" name="PostalCode" />
                    </div>
                </div>

                <div class="halign">
                    <div class="align">
                        <label for="TaxType" class="form-label">نوع مالیات</label>
                        <select class="form-select" name="TaxType" required>
                            <option selected>انتخاب کنید</option>
                            <option value="5">مودی مشمول ثبت نام در نظام مالیاتی</option>
                            <option value="6">مشمولین حقیقی ماده ۸۱</option>
                            <option value="7">اشخاصی که مشمول ثبت نام در نظام مالیاتی نیستند</option>
                            <option value="8">مصرف کننده نهایی</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="Active" class="form-label">وضعیت شخص</label>
                        <select class="form-select" name="Active" required>
                            <option selected>انتخاب کنید</option>
                            <option value="true">فعال</option>
                            <option value="false">غیرفعال</option>
                        </select>
                    </div>
                    <div class="align">
                        <label for="ContactCredit" class="form-label">اعتبار مالی</label>
                        <input class="form-control" type="text" name="ContactCredit" />
                    </div>
                    <div class="align">
                        <label for="Phone" class="form-label">تلفن</label>
                        <input class="form-control" type="text" name="Phone" />
                    </div>
                    <div class="align">
                        <label for="Mobile" class="form-label">موبایل</label>
                        <input class="form-control" type="text" name="Mobile" />
                    </div>
                    <div class="align">
                        <label for="Fax" class="form-label">فکس</label>
                        <input class="form-control" type="text" name="Fax" />
                    </div>
                </div>
                <br><br>
                <button class="btn btn-primary" name="saveContact" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>


