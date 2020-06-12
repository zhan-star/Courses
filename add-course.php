<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $course = (new CourseMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' курс';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-course.php">Курсы</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-course.php" method="POST">
        <div class="form-group">
            <label>Название курса</label>
            <input type="text" class="form-control"name="name" required="required" value="<?=$course->name;?>">
        </div>
        <div class="form-group">
            <label>Тип курса</label>
            <select class="form-control" name="coursetype_id">
                <?= Helper::printSelectOptions(0, (new CourseMap())->arrCoursetypes());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="saveCourse" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="course_id"value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>