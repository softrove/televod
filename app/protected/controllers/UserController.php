<?php
/**
 * Created by PhpStorm.
 * User: waqqasjabbar
 * Date: 3/16/15
 * Time: 11:58 PM
 */

class UserController extends CController{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter +
                REST.GET, REST.PUT, REST.POST, REST.DELETE, REST.OPTIONS'
            ),
        );
    }

    public function actions()
    {
        return array(
            'REST.' => 'RestfullYii.actions.ERestActionProvider',
        );
    }
}