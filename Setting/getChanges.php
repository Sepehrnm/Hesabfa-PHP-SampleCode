<?php
error_reporting(0);
    include '../API/class-api.php';
    $api = new Ssbhesabfa_Api();
    session_start();

    global $result, $start;
    global $rpp, $i;

    if(isset($_POST["submit"])) {
        $start = $_POST["from"];
        $_SESSION["start"] = $start;
        $result = $api->settingGetChanges($start);
    }

    if(isset($_POST["buttonSubmitPrevious"])) {
        $start = $_SESSION["start"];
        $start -= 10;
        $_SESSION["start"] = $start;
        $result = $api->settingGetChanges($start);
    }

    if(isset($_POST["buttonSubmitNext"])) {
        $start = $_SESSION["start"];
        $start += 10;
        $_SESSION["start"] = $start;
        $result = $api->settingGetChanges($start);
    }

?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت آخرین تغییرات</title>
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
                دریافت آخرین تغییرات
            </h3>
            <br>
        <form class="save-contact-form" method="post" style="direction: rtl;">
            <div class="align"><label for="from">از شناسه</label></div>
            <input style="margin: 0.5rem;" class="from" type="text" name="from">
            <button name="submit" class="btn btn-primary" type="submit">نمایش</button>
        </form>
        <br><br>
        <?php if($result) { $changes = $result->{'Result'};
            if($changes) {
        ?>
            <table class="table table-striped table-hover">

                <th>ID</th>
                <th>تاریخ و ساعت تغییر</th>
                <th>نوع عملیات</th>
                <th>شناسه ماهیتی که تغییر کرده</th>
                <th>نوع ماهیت</th>
                <th>Extra</th>
                <th>Extra2</th>
                <th>API</th>
                <?php
                $i=0;
                $rpp=10;
                foreach ($changes as $change) {
                if($i < $rpp) {
                ?>
                    <tr>
                        <td><?php echo $change->Id; ?></td>
                        <td><?php echo $change->DateTime; ?></td>
                        <td><?php echo $change->Action; ?></td>
                        <td><?php echo $change->ObjectId; ?></td>
                        <td><?php echo $change->ObjectType; ?></td>
                        <td><?php echo $change->Extra; ?></td>
                        <td><?php echo $change->Extra2; ?></td>
                        <td><?php echo $change->API; ?></td>

                    </tr>
            <?php    }
                $i++;
                } ?>
            </table>
            <form method="post">
                <div class="button-container" id="button-container">
                    <button type="submit" name="buttonSubmitPrevious" class="buttonInput btn btn-primary">قبلی</button>
                    <button type="submit" name="buttonSubmitNext" class="buttonInput btn btn-primary">بعدی</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <?php    } } ?>
</body>
</html>

