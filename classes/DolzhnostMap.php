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
class DolzhnostMap extends BaseMap
{
    public function arrDolzhnosti()
    {
        $res = $this->db->query("SELECT dolzhnost_id AS id, name AS value FROM dolzhnost d");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public function arrGenders()
    {
        $res = $this->db->query("SELECT gender_id AS id, name AS value FROM genders");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }


    
}