<?php
error_reporting(0);
include '../API/class-api.php';
$api = new Ssbhesabfa_Api();

$result = $api->settingGetProjects();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS%20Files/style.css" />
    <?php include "../Bootstrap/SharedLinks.php";?>
    <link rel="icon" href="../assets/hesabfaIcon.png">
    <title>دریافت لیست پروژه ها</title>
</head>
<body>
<div class="container-fluid">
    <?php include '../Navbar Menu/navbar.php'; ?>
</div>
<?php include '../Errors/errorLog.php';?>

<?php if($result) { $projects = $result->{'Result'};
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>
                دریافت لیست پروژه ها
            </h3>
            <br>
            <table class="table table-striped table-hover">
                <th>نام پروژه</th>
                <th>فعال بودن پروژه</th>
                <?php foreach ($projects as $project) { ?>
                <tr>
                    <td><?php echo $project->Title; ?></td>
                    <td><?php if($project->Active) echo "فعال"; else echo "غیرفعال" ?></td>
                </tr>
                <?php } } else {echo "چیزی برای نمایش نیست";}?>
            </table>
        </div>
    </div>
</div>
</body>
</html>