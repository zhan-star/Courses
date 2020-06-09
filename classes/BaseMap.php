<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Жан
 */
abstract class BaseMap extends Config {
        /**
    * @var PDO
    */
    protected $db;
    function __construct()
    {
        try
        {
            $this->db = new
            PDO('mysql:host='.self::HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8");
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}
