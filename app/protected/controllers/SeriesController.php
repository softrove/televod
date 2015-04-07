<?php

/**
 * Created by PhpStorm.
 * User: waqqasjabbar
 * Date: 3/15/15
 * Time: 12:43 PM
 */
class SeriesController extends CController
{

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

    public function accessRules()
    {
        return array(
            array('allow', 'actions' => array('REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE', 'REST.OPTIONS'),
                'users' => array('*'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function restEvents()
    {
        $this->onRest('post.filter.req.auth.ajax.user',
            function(){
                return true;
            });

        $this->onRest('req.cors.access.control.allow.origin', function() {
            if($key = Yii::app()->getRequest()->getParam('key')) {
                $origins = Origin::model()->findAll(array(
                    'with' => array('key_search' =>
                        array(
                            'select' => false,
                            'together' => true,
                        )
                    )
                ));

                return array_map(function($origin){
                    return $origin->url;
                }, $origins);
            }
            return array();
        });

        $this->onRest('req.cors.access.control.allow.methods', function() {
            return ['GET', 'POST', 'PUT', 'DELETE','OPTIONS'];
        });
    }
}