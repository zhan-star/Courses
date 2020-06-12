<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author Жан
 */
class TicketMap extends BaseMap
{
    public function arrTickets()
    {
        $res = $this->db->query("SELECT ticket_id AS id, CONCAT(c.name,', ',p.datestart,', ', o.name) as value FROM ticket 
        INNER JOIN pin p ON ticket.pin_id = p.pin_id
        INNER JOIN organization o ON ticket.organization_id = o.organization_id
        INNER JOIN course c ON p.course_id = c.course_id");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save(Ticket $ticket) {
        if ($ticket->validate()) {
            if ($ticket->ticket_id == 0) {
                return $this->insert($ticket);
            } else {
                return $this->update($ticket);
            }
        }
        return false;
    }
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT ticket_id AS id, c.name as value FROM ticket 
            INNER JOIN pin p ON ticket.pin_id = p.pin_id
            INNER JOIN course c ON p.course_id = c.course_id WHERE ticket_id = $id");
            return $res->fetchObject("Ticket");
        }
        return new Ticket();
    }
    private function insert(Ticket $ticket){
        $pin_id = $ticket->pin_id;
        $organization_id = $ticket->organization_id;
        if ($this->db->exec("INSERT INTO ticket(pin_id, organization_id) VALUES($pin_id,$organization_id)") == 1 ) {
            $ticket->ticket_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Ticket $ticket){
        $pin_id = $this->db->quote($ticket->$pin_id);
        $organization_id = $this->db->quote($ticket->$organization_id);
        if ( $this->db->exec("UPDATE ticket SET pin_id = $pin_id, organization_id= $organization WHERE ticket_id = ".$ticket->ticket_id) == 1) {
            return true;
        }
        return false;
    }
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT course.course_id, course.name, course.coursetype, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts, p.datestart, p.dateend, p.price FROM course
            INNER JOIN pin p ON course.course_id = p.course_id WHERE course.course_id = $id
            ORDER BY p.course_id ");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function findGroup($id=null){
        if ($id) {
            $res = $this->db->query("SELECT CONCAT(USER.lastname,' ',USER.firstname,' ',USER.patronymic) AS fio FROM user 
            INNER JOIN student s ON user.user_id = s.student_id
            INNER JOIN student_ticket st ON s.student_id = st.student_id
            inner join ticket t ON st.ticket_id = t.ticket_id
            INNER JOIN pin p ON t.pin_id = p.pin_id
            INNER JOIN course c ON p.course_id = c.course_id
            WHERE p.course_id='$id'");
            return $res->fetchAll(PDO::FETCH_OBJ);
        }
        return false;
    }
    
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT course.course_id, course.name, course.coursetype, (SELECT COUNT(*) FROM courses.student_ticket st WHERE st.ticket_id = course.course_id) AS cnts, p.datestart, p.dateend, p.price FROM course
        INNER JOIN pin p ON course.course_id = p.course_id
        ORDER BY p.course_id ". "LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function findAll2($id=null){
        if ($id) {
            $res = $this->db->query("SELECT COUNT(*) FROM user 
        INNER JOIN student s ON user.user_id = s.student_id
        INNER JOIN student_ticket st ON s.student_id = st.student_id
        inner join ticket t ON st.ticket_id = t.ticket_id
        INNER JOIN pin p ON t.pin_id = p.pin_id
        INNER JOIN course c ON p.course_id = c.course_id
        WHERE p.course_id='$id'");
        return $res->fetch(PDO::FETCH_NUM);
        }
        return false;
    }

 

    
}