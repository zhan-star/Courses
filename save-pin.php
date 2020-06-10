<?php
require_once 'secure.php';
if (isset($_POST['pin_id'])) {
$pin = new Pin();
$pin->pin_id =Helper::clearInt($_POST['pin_id']);
$pin->teacher_id = Helper::clearString($_POST['teacher_id']);
$pin->course_id =Helper::clearString($_POST['course_id']);
$pin->datestart =Helper::clearString($_POST['datestart']);
$pin->dateend =Helper::clearString($_POST['dateend']);
$pin->price =Helper::clearInt($_POST['price']);
if ((new PinMap())->save($pin)) {
header('Location: list-pin.php');
} else {
if ($pin->pin_id) {
header('Location: add-pin.php?id='.$pin->pin_id);
} else {
header('Location: add-pin.php');
}
}
}