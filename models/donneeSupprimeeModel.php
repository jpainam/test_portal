<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of donneeSupprimeeModel
 *
 * @author Paul
 */
class donneeSupprimeeModel extends Model{
    protected $_key = "IDDONNEE";
    protected $_table = "donnees_supprimees";
    
    public function __construct() {
        parent::__construct();
    }
}
