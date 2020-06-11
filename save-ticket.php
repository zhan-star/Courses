<?php
require_once 'secure.php';
if (isset($_POST['ticket_id'])) {
$ticket = new Ticket();
$ticket->ticket_id =Helper::clearInt($_POST['ticket_id']);
$ticket->pin_id = Helper::clearInt($_POST['pin_id']);
$ticket->organization_id =Helper::clearInt($_POST['organization_id']);
if ((new TicketMap())->save($ticket)) {
header('Location: success.php');
} else {
if ($ticket->ticket_id) {
header('Location: add-ticket.php?id='.$ticket->ticket_id);
} else {
header('Location: list-course.php');
}
}
}