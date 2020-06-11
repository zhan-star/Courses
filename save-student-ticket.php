<?php
require_once 'secure.php';
if (isset($_POST['student_ticket_id'])) {
$studentticket = new StudentTicket();
$studentticket->student_ticket_id =Helper::clearInt($_POST['student_ticket_id']);
$studentticket->student_id = Helper::clearInt($_POST['student_id']);
$studentticket->ticket_id =Helper::clearInt($_POST['ticket_id']);
if ((new StudentTicketMap())->save($studentticket)) {
header('Location: success.php');
} else {
if ($studentticket->student_ticket_id) {
header('Location: add-student-ticket.php?id='.$studentticket->student_ticket_id);
} else {
header('Location: list-filling.php');
}
}
}