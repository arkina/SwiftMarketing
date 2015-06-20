<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
class Member extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     * 
     * @validate required
     * @label name
     */
    protected $_name;
    
    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     * 
     * @validate required
     * @label description
     */
    protected $_description;   
}