<?php
    require_once 'secure.php';
    $id = 0;
    if (isset($_GET['id'])) {
        $id = Helper::clearInt($_GET['id']);
    }
    $ticket = (new TicketMap())->findById($id);
    $header = (($id)?'Редактировать':'Добавить').' заявку организации';
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
    <form action="save-ticket.php" method="POST">
        <div class="form-group">
            <label>Закрепленный курс</label>
            <select class="form-control" name="pin_id">
                <?= Helper::printSelectOptions(0, (new PinMap())->arrPins());?>
            </select>
        </div>
        <div class="form-group">
            <label>Ответственная организация</label>
            <select class="form-control" name="organization_id">
                <?= Helper::printSelectOptions(0, (new OrganizationMap())->arrOrganizations());?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="saveTicket" class="btn btn-primary">Сохранить</button>
        </div>
        <input type="hidden" name="ticket_id"value="<?=$id;?>"/>
    </form>
</div>
<?php
    require_once 'template/footer.php';
?>