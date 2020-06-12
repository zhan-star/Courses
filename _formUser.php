<?php
$userMap = new UserMap();
$user = $userMap->findById($id);
?>
<div class="form-group">
    <label>Фамилия</label>
    <input type="text" class="form-control"
           name="lastname" required="required" value="<?= $user ->lastname;?>">
</div>
<div class="form-group">
    <label>Имя</label>
    <input type="text" class="form-control"
           name="firstname" required="required" value="<?= $user ->firstname;?>">
</div>
<div class="form-group">
    <label>Отчество</label>
    <input type="text" class="form-control"
           name="patronymic" value="<?= $user->patronymic; ?>">
</div>
<input type="hidden" name="user_id" value="<?= $id; ?>"/>