<?php
declare(strict_types=1);

final class WebRoutes
{
    public static function routes(): array
    {
        return array(
            'home' => array('method' => 'GET', 'action' => 'home'),

            'carreras.create' => array('method' => 'GET', 'action' => 'create'),
            'carreras.store' => array('method' => 'POST', 'action' => 'store'),
            'carreras.index' => array('method' => 'GET', 'action' => 'index'),
            'carreras.show' => array('method' => 'GET', 'action' => 'show'),
            'carreras.edit' => array('method' => 'GET', 'action' => 'edit'),
            'carreras.update' => array('method' => 'POST', 'action' => 'update'),
            'carreras.delete' => array('method' => 'POST', 'action' => 'delete'),

            'auth.login' => array('method' => 'GET', 'action' => 'login'),
            'auth.authenticate' => array('method' => 'POST', 'action' => 'authenticate'),
            'auth.logout' => array('method' => 'GET', 'action' => 'logout'),
            'auth.forgot' => array('method' => 'GET', 'action' => 'forgot'),
            'auth.forgot.send' => array('method' => 'POST', 'action' => 'forgot.send'),
        );
    }
}