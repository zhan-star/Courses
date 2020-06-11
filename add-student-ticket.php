<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $studentticket = (new StudentTicketMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' студента в '.(($id)?'группе':'группу');
    require_once 'template/header.php';
?>
<section class="content-header">
    <h1><?=$header;?></h1>
    <ol class="breadcrumb">
        <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="list-filling.php">Группы</a></li>
        <li class="active"><?=$header;?></li>
    </ol>
</section>
<div class="box-body">
    <form action="save-student-ticket.php" method="POST">
        <div class="form-group">
            <label>Заявка курса</label>
            <select class="form-control" name="ticket_id">
                <?= Helper::printSelectOptions(0, (new TicketMap())->arrTickets());?>
            </select>
        </div>
        <div class="form-group">
            <label>Студент</label>
            <select class="form-control" name="student_id">
                <?= Helper::printSelectOptions(0, (new StudentMap())->arrStudents());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="saveStudentTicket" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="student_ticket_id"value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>