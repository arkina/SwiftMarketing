<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
class Message extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     * 
     * @validate required
     * @label subject
     */
    protected $_subject;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     * 
     * @validate required
     * @label body
     */
    protected $_body;
}
