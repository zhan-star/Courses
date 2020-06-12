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
class TeacherMap extends BaseMap{
    public function arrTeachers()
    {
        $res = $this->db->query("SELECT teacher_id as id, CONCAT(u.lastname,' ',u.firstname) AS value FROM teacher 
        INNER JOIN user u ON teacher.teacher_id = u.user_id");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic) AS fio, teacher.birthday, g.name, teacher.education, teacher.category FROM teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            INNER JOIN genders g ON teacher.gender = g.gender_id " . " WHERE teacher.teacher_secondary = $id");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;        

    }
    public function findById($id = null)
    {
        if ($id) {
            $res = $this->db->query("SELECT teacher_id, birthday, gender, education, category FROM teacher WHERE teacher_id = $id");
            $teacher = $res->fetchObject("Teacher");
            if ($teacher) {
                return $teacher;
            }
        }
        return new Teacher();
    }
    public function save(User $user, Teacher $teacher){
        if ($user->validate() && $teacher->validate() && (new UserMap())->save($user)) {
            if ($teacher->user_id == 0) {
                $teacher->user_id = $user->user_id;
                return $this->insert($teacher);
            } 
            else {
                return $this->update($teacher);
            }
        }
        return false;
    }
    private function insert(Teacher $teacher){
        $teacher_id = $teacher->teacher_id;
        $birthday = $this->db->quote($teacher->birthday);
        $gender = $teacher->gender;
        $education = $this->db->quote($teacher->education);
        $category = $this->db->quote($teacher->category);
        if ($this->db->exec("INSERT INTO teacher (teacher_id, birthday, gender, education, category) VALUES($teacher->user_id, $birthday, $gender, $education, $category)")== 1) {
            return true;
        }
        return false;
    }
    private function update(Teacher $teacher){
        $teacher_id = $teacher->teacher_id;
        $birthday = $this->db->quote($teacher->birthday);
        $gender = $teacher->gender;
        $education = $this->db->quote($teacher->education);
        $category = $this->db->quote($teacher->category);
        if ($this->db->exec("UPDATE teacher SET birthday = $birthday, gender=$gender, education=$education, category=$category WHERE teacher_id=".$teacher->teacher_id) ==1) {
            return true;
        }
        return false;
    }
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT teacher_secondary AS id, teacher_id as ids, u.lastname AS lastname, u.firstname AS firstname, u.patronymic AS patronymic, g.name as gender, birthday, education, category  FROM teacher 
        INNER JOIN user u ON teacher.teacher_id = u.user_id
        INNER JOIN genders g ON teacher.gender = g.gender_id ORDER BY teacher_secondary LIMIT $ofset, $limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }
    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM teacher");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }
    public function findProfileById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT teacher.user_id,
            otdel.name AS otdel FROM teacher "
            . "INNER JOIN otdel ON
            teacher.otdel_id=otdel.otdel_id WHERE teacher.user_id =
            $id");
            return $res->fetch(PDO::FETCH_OBJ);
            }
            return false;
    }
}

