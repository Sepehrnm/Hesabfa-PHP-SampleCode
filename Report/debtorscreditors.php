<?php
error_reporting(0);

    include "../API/class-api.php";
    $api = new Ssbhesabfa_Api();
    global $i, $rpp, $startDate, $endDate, $project, $totalCount, $result;

    if(isset($_POST["submitRequest"])) {
        $startDate = $_POST["startDate"] ? : null;
        $endDate = $_POST["endDate"] ? : null;
        $project = $_POST["project"] ? : null;
        $i = 0;
        $rpp = 10;

        $data = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'project' => $project
        );
        $result = $api->reportDebtorsCreditors($data);
        $totalCount = count($result->{"Result"});
    } else {
        $data = array(
            'startDate' => null,
            'endDate' => null,
            'project' => null
        );
        $i = 0;
        $rpp = 10;

        $result = $api->reportDebtorsCreditors($data);
        $totalCount = count($result->{"Result"});
    }

    if($totalCount % 10 != 0) $totalCount += 10;
    if(isset($_POST["buttonSubmit"])) {
        for($j=0 ; $j<(($totalCount)/10) ; $j++) {
            if(isset($_POST["buttonSubmit"][$j])) {
                $value = $_POST["buttonInput"][$j];
                $rpp = ($value * 10);
                $i = ($rpp - 10);
                $data = array(
                    'startDate' => $startDate ? : null,
                    'endDate' => $endDate ? : null,
                    'project' => $project ? : null,
                );
                $result = $api->reportDebtorsCreditors($data);
            }
        }
    }
?>


<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>گزارش بدهکاران و بستانکاران</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php'; ?>
<br>
<h3>
    گزارش بدهکاران و بستانکاران
</h3>
<br>
<form class="save-contact-form" method="post" style="direction: rtl;">
    <div class="halign" style="padding: 0.5rem;">
        <div class="align">
            <label class="form-label" for="startDate">تاریخ شروع</label>
            <input class="form-control" type="text" name="startDate" placeholder="(2023-03-26T00:00:00)">
        </div>
        <div class="align">
            <label class="form-label" for="endDate">تاریخ پایان</label>
            <input class="form-control" type="text" name="endDate" placeholder="(2024-03-25T00:00:00)">
        </div>
        <div class="align">
            <label class="form-label" for="project">نام پروژه</label>
            <input class="form-control" type="text" name="project">
        </div>
    </div>
    <button name="submitRequest" class="btn btn-primary" type="submit">نمایش</button>
</form>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table style="text-align: center;" class="table table-striped table-hover">
                <tr>
                    <th>کد</th>
                    <th>نام</th>
                    <th>عنوان</th>
                    <th>گروه</th>
                    <th>
                        بدهکار
                    </th>
                    <th>
                        بستانکار
                    </th>
                </tr>

                <?php
                $persons = ($result->{"Result"});
                for ($j=$i ; $j<$rpp ; $j++) {
                    if(isset($persons[$j]->Code)) {?>
                <tr>
                    <td><?php echo($persons[$j]->Code);?></td>
                    <td><?php echo($persons[$j]->Name);?></td>
                    <td><?php echo($persons[$j]->NodeName);?></td>
                    <td><?php echo($persons[$j]->NodeFamily);?></td>
                    <td style="color: red;font-weight: bold;"><?php echo($persons[$j]->Debit);?></td>
                    <td style="color: green;font-weight: bold;"><?php echo($persons[$j]->Credit);?></td>
                </tr>
                <?php } }?>
            </table>
            <form method="post">
                <div class="button-container">
                    <?php
                    for($z=1 ; $z<=($totalCount/10) ; $z++) {
                        ?>
                        <button type="submit" name="buttonSubmit[<?php echo $z;?>]" class="buttonInput btn btn-primary" value="<?php echo $z;?>"><?php echo $z;?>
                            <input name="buttonInput[<?php echo $z;?>]" type="hidden" value="<?php echo $z;?>" />
                        </button>
                    <?php  } ?>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
