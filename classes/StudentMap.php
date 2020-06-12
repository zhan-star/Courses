<?php

class StudentMap extends BaseMap {

    public function arrStudents()
    {
        $res = $this->db->query("SELECT student_id AS id, CONCAT(u.lastname,' ',u.firstname) AS value FROM student
        INNER JOIN user u ON student.student_id = u.user_id");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT student_id, dolzhnost_id FROM student WHERE student_id = $id");
            $student = $res->fetchObject("Student");
            if ($student) {
                return $student;
            }
        }
        return new Student();
    }

    public function save(User $user, Student $student)
    {

        if ($user->validate() && $student->validate() && (new UserMap())->save($user)) {
            if ($student->student_id == 0) {
                $student->student_id = $user->user_id;
                return $this->insert($student);
            } else {
                return $this->update($student);
            }
        }
        return false;

    }

    private function insert(Student $student)
    {
        if ($this->db->exec("INSERT INTO student (student_id, dolzhnost_id) VALUES ($student->student_id, $student->dolzhnost_id)")  == 1) {
            return true;
        }
        return false;
    }

    private function update(Student $student)
    {
        if ($this->db->exec("UPDATE $student SET dolzhnost_id = $student->dolzhnost_id WHERE student_id=" . $student->student_id) == 1) {
            return true;
        }
        return false;
    }

    public function findAll($ofset = 0, $limit = 30)
    {

        $res = $this->db->query("SELECT student_secondary AS id, student_id as ids, u.lastname AS lastname, u.firstname AS firstname, u.patronymic AS patronymic, d.name as dolzhnost FROM student 
        INNER JOIN user u ON student.student_id = u.user_id
        INNER JOIN dolzhnost d ON student.dolzhnost_id = d.dolzhnost_id LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);

    }

    public function count()
    {
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM student");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    public function findProfileById($id = null) {

        if ($id) {
            $res = $this->db->query("SELECT student.user_id, gruppa.name AS gruppa FROM student "
                . "INNER JOIN gruppa ON student.gruppa_id=gruppa.gruppa_id WHERE student.user_id = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

}