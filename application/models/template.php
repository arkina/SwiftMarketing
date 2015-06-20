<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
class Template extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @validate required
     * @label campaign id
     */
    protected $_campaign_id;
    
    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @validate required
     * @label message id
     */
    protected $_message_id;
    
    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @validate required
     * @label pipeline
     */
    protected $_pipeline;   
}
