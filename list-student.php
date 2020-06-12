<?php
require_once 'secure.php';
$size = 8;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$studentMap = new StudentMap();
$count = (new StudentMap())->count();
$students = $studentMap->findAll($page*$size-$size, $size);
$header = 'Студенты';
require_once 'template/header.php';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <section class="content-header">
                <h1><?=$header;?></h1>
                <ol class="breadcrumb">
                    <li><a href="/index.php"><i class="fa fa-dashboard"></i>Главная</a></li>
                    <li class="active"><?=$header;?></li>
                </ol>
            </section>
            
            <div class="box-body">
                <?php
                if ($students) {
                    ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Должность</th>
                            <!--<th></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($students as $student) {

                            echo '<tr>';
                            echo '<td>'.$student->lastname.'</td>';
                            echo '<td>'.$student->firstname.'</td>';
                            echo '<td>'.$student->patronymic.'</td>';
                            echo '<td>'.$student->dolzhnost.'</td>';
                            //echo '<td><a href="add-student.php?id='.$student->ids.'">ред.</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table> 
                    <?php
                } 
                else {
                    echo 'Студенты не найдены';
                } 
                ?>
            </div>
            <div class="box-body">
                <a class="btn btn-success" href="add-student.php">Добавить студента</a>
            </div>
            <div class="box-body"><h5>Всего студентов: <?php echo $count; ?> </h5></div>
            <div class="box-body">
                <?php Helper::paginator($count, $page,$size); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>