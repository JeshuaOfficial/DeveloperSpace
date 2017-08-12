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
 * Modelo Redes
 *
 * @author DevSystemVzla <devsystemvzla@gmail.com>
 */

class Redes extends Models implements ModelsInterface {

    // Contenido del modelo... 


    /**
      * __construct()
    */
    public function __construct(RouterInterface $router = null) {
        parent::__construct($router);
    }
    /**
     * Obtiene la configuración de redes sociales
     * @return array con las redes sociales
     */
    final public function getRedes() {
        return $this->db->select('*', 'redes', "id_red = '1'",'LIMIT 1');
    }

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
    }
}