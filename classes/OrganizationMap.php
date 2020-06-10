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
class OrganizationMap extends BaseMap
{
    public function arrOrganizations()
    {
        $res = $this->db->query("SELECT pin_id AS id, course_id AS value FROM otdel");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save(Organization $organization) {
        if ($organization->validate()) {
            if ($organization->organization_id == 0) {
                return $this->insert($organization);
            } else {
                return $this->update($organization);
            }
        }
        return false;
    }
    public function findById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT organization_id, name, address, phone,email FROM organization WHERE organization_id = $id");
            return $res->fetchObject("Organization");
        }
        return new Organization();
    }
    private function insert(Organization $organization){
        $name = $this->db->quote($organization->name);
        $address = $this->db->quote($organization->address);
        $phone = $this->db->quote($organization->phone);
        $email = $this->db->quote($organization->email);
        if ($this->db->exec("INSERT INTO organization(name,address,phone,email) VALUES($name,$address,$phone,$email)") == 1 ) {
            $organization->organization_id = $this->db->lastInsertId();
            return true;
        }
        return false;
    }
    private function update(Organization $organization){
        $name = $this->db->quote($organization->name);
        $address = $this->db->quote($organization->address);
        $phone = $this->db->quote($organization->phone);
        $email = $this->db->quote($organization->email);
        if ( $this->db->exec("UPDATE organization SET name = $name, address= $address, phone=$phone, email=$email WHERE organization_id = ".$organization->organization_id) == 1) {
            return true;
        }
        return false;
    }
    public function findViewById($id=null){
        if ($id) {
            $res = $this->db->query("SELECT * FROM organization  ". "WHERE organization.organization_id='$id'");
            return $res->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }
    public function setTeacherId(){ 
            $res = $this->db->query("SELECT teacher.teacher_secondary from teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            WHERE CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic)='Боднарь Дмитрий Максимович' ");
            //return $res->fetchAll(PDO::FETCH_NUM); 
            $query="SELECT teacher.teacher_secondary from teacher
            INNER JOIN user u ON teacher.teacher_id = u.user_id
            WHERE CONCAT(u.lastname,' ',u.firstname,' ',u.patronymic)='Боднарь Дмитрий Максимович' ";
            $link = mysqli_connect("127.0.0.1", "root", "root", "courses");
            $result = mysqli_query($link, $query);
            return $result;  
    }
    public function findAll($ofset=0, $limit=30){
        $res = $this->db->query("SELECT * FROM organization  ". "LIMIT $ofset,$limit");
        return $res->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(){
        $res = $this->db->query("SELECT COUNT(*) AS cnt FROM pin");
        return $res->fetch(PDO::FETCH_OBJ)->cnt;
    }

    
}