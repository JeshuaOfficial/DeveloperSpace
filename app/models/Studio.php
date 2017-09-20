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
 * Modelo Studio
 *
 * @author DevSystemVzla <devsystemvzla@gmail.com>
 */

class Studio extends Models implements ModelsInterface {

    /**
     * Imagen principal
     * @var string
     */
    const MAIN_IMAGE = 1400;
    

    /**
      * __construct()
    */
    public function __construct(RouterInterface $router = null) {
        parent::__construct($router);
    }
    /**
     * Obtiene toda la información de estudio
     * @return array
     */
    final public function get(){
        return $this->db->select('*', 'estudio', "id_estudio = '1'", 'LIMIT 1')[0];
    }

    final public function getImages(string $dir) {
        
      return glob($dir . self::MAIN_IMAGE . '/*')[0];
    }

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
    }
}