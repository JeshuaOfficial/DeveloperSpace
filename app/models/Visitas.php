<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\ModelsInterface;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Router\RouterInterface;

/**
 * Modelo Visitas
 *
 * @author DevSystemVzla <devsystemvzla@gmail.com>
 */

class Visitas extends Models implements ModelsInterface {

   
    /**
      * __construct()
    */
    public function __construct(RouterInterface $router = null) {
        parent::__construct($router);
    }
    /**
     * Controla las visitas diarias
     * @return void
     */
    final public function contar() {
        global $http, $session;
        $ip_user = $http->server->get('REMOTE_ADDR');
        $users_ip = $session->get('users_ip');
        $visitas = $this->db->select('*', 'visitas', "id_visita = '1'", 'LIMIT 1')[0];
   
        if ( $visitas['time'] <= time() ) {
            $new_time = (time() + (60*60*24));
            
            $this->db->update('visitas',['time' => $new_time, 'contador' => '0'], "id_visita = '1'", 'LIMIT 1');
            $session->set('users_ip', []);
            $visitas = $this->db->select('*', 'visitas', "id_visita = '1'", 'LIMIT 1')[0];
        }

        
        if (null == $session->get('users_ip') || !in_array($ip_user, $users_ip)) {

            $users_ip[] = $ip_user;
            $session->set('users_ip', $users_ip);
            $visitas['contador'] = $visitas['contador'] + 1;
            
            $this->db->update('visitas', ['contador' => $visitas['contador']], "id_visita = '1'",'LIMIT 1');
        }
        
    }

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
    }
}