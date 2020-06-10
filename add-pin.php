<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $pin = (new PinMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' заявку';
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-pin.php">Заявки</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-pin.php" method="POST">
        <div class="form-group">
            <label>Курс</label>
            <select class="form-control" name="course_id">
                <?= Helper::printSelectOptions(0, (new CourseMap())->arrCourses());?>
            </select>
        </div>
        <div class="form-group">
            <label>Преподаватель</label>
            <select class="form-control" name="teacher_id">
                <?= Helper::printSelectOptions(0, (new TeacherMap())->arrTeachers());?>
            </select>
        </div>
        <div class="form-group">
            <label>Дата начала</label>
            <input type="date" class="form-control" name="datestart" required="required" value="<?=$pin->datestart;?>">
        </div>
        <div class="form-group">
            <label>Дата окончания</label>
            <input type="date" class="form-control" name="datestart" required="required" value="<?=$pin->dateend;?>">
        </div>
        <div class="form-group">
            <label>Цена</label>
            <input type="number" class="form-control" name="datestart" required="required" value="<?=$pin->price;?>">
        </div>
        <div class="form-group">
            <button type="submit" name="savePin" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="pin_id" value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>