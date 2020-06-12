<?php
require_once 'secure.php';
$size = 5;
if (isset($_GET['page'])) {
    $page = Helper::clearInt($_GET['page']);
} else {
    $page = 1;
}
$pinMap = new PinMap();
$courseMap = new CourseMap();
$count = $pinMap->count();
$pins = $pinMap->findAll($page*$size-$size, $size);
$courses=$courseMap->findAll($page*$size-$size, $size);

$header = 'Расписание преподавателей';
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
                if ($pins) {
                    ?>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Преподаватель</th>
                            <th>Название курса</th>
                            <th>Начало</th>
                            <th>Конец</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($pins as $pin) {  
                        $query="SELECT teacher.teacher_secondary from teacher
                        INNER JOIN user u ON teacher.teacher_id = u.user_id
                        WHERE CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic)='$pin->fio' ";
                        $link = mysqli_connect("localhost", "root", "root", "courses");
                        $result = mysqli_query($link, $query);
                        while ($row = $result->fetch_assoc()) {
                            $final=$row['teacher_secondary'];
                        }
                        $query2="SELECT course.course_id FROM course
                        WHERE course.name = '$pin->name' ";
                        $result2 = mysqli_query($link, $query2);
                        while ($row2 = $result2->fetch_assoc()) {
                            $final2=$row2['course_id'];
                        }
                            echo '<tr>';
                            echo '<td><a href="view-teacher.php?id='.$final.'">'.$pin->fio.'</a></td>';
                            echo '<td><a href="view-courses.php?id='.$final2.'">'.$pin->name.'</a></td>';
                            echo '<td>'.$pin->datestart.'</td>';
                            echo '<td>'.$pin->dateend.'</td>';
                           
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table> 
                    <?php
                } 
                else {
                    echo 'Расписание не найдено';
                } 
                ?>
            </div>
            <div class="box-body">
                <a class="btn btn-success" href="search-pin.php">&#x1F50D; Искать по дате</a>
            </div>
            <div class="box-body">
                <?php Helper::paginator($count, $page,$size); ?>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'template/footer.php';
?>