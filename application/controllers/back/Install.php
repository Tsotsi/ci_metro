<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Install
 *
 * @author Tsotsi
 */
class Install extends TT_Controller{
    //put your code here
    public function init()
    {
        
        try
        {
            $sentry=Cartalyst\Sentry\Facades\CI\Sentry::createSentry();
            $group=$sentry->createGroup(array(
                'name'=>'Admin',
                'permissions'=>array(
                    'admin'=>1,
                    'users'=>1,
                )
            ));
            $user=$sentry->createUser(array(
                'username'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>md5(111111),
                'activated'=>TRUE
            ));
            $user->addGroup($group);
           
        } catch (Exception $exc)
        {
            echo $exc->getTraceAsString();
        }
        }
}
