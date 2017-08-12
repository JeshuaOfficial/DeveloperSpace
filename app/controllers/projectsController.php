<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\RouterInterface;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\ControllersInterface;
use Ocrend\Kernel\Helpers\Strings;
  
/**
 * Controlador projects/
 *
 * @author Brayan Narváez <prinick@ocrend.com>
*/
  
class projectsController extends Controllers implements ControllersInterface {

    public function __construct(RouterInterface $router) {
        parent::__construct($router);   
        
        # instancia del modelo
        $p = new Model\Proyectos($router);

        if (is_numeric($this->method)) {

        	if (false != ($data = $p->get($this->method))) {

        	    echo $this->template->render('projects/detalles',array(
					'categories' => $p->getCategories(),
					'project' => $data[0],
					'gallery' => $p->getGallery($this->method)
				));
        	}	
        	
        }else{
        	echo $this->template->render('projects/projects',array(
				'categories' => $p->getCategories(),
				'projects' => $p->get()
			));
        }
		

    }

}