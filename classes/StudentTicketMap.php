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
class StudentTicketMap extends BaseMap
{
    public function arrStudentTickets()
    {
        $res = $this->db->query("SELECT ticket_id AS id, c.name as value FROM ticket 
        INNER JOIN pin p ON ticket.pin_id = p.pin_id
        INNER JOIN course c ON p.course_id = c.course_id");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save(StudentTicket $studentticket) {
        if ($studentticket->validate()) {
            if ($studentticket->studentticket_id == 0) {
                return $this->insert($studentticket);
            } else {
                return $this->update($studentticket);
            }
        }
        return false;
    }
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT student_ticket_id AS id, CONCAT(u.lastname,' ',u.firstname) as value FROM student_ticket st
            INNER JOIN ticket t ON st.ticket_id = t.ticket_id
            INNER JOIN student s ON st.student_id = s.student_id
            inner join user u ON s.student_id = u.user_id WHERE student_ticket_id = $id");
            return $res->fetchObject("StudentTicket");
        }
        return new StudentTicket();
    }
    private function insert(StudentTicket $studentticket){
        $student_id = $studentticket->student_id;
        $ticket_id = $studentticket->ticket_id;
        if ($this->db->exec("INSERT INTO student_ticket(student_id, ticket_id) VALUES($student_id,$ticket_id)") == 1 ) {
            $studentticket->studentticket_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(StudentTicket $studentticket){
        $student_id = $studentticket->student_id;
        $ticket_id = $studentticket->ticket_id;
        if ( $this->db->exec("UPDATE student_ticket SET student_id = $student_id, ticket_id= $ticket_id WHERE student_ticket_id = ".$studentticket->student_ticket_id) == 1) {
            return true;
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

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM course");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    
}