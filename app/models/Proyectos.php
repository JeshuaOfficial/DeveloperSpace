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
use Ocrend\Kernel\Helpers\Strings;


/**
 * Modelo Test
 *
 * @author Brayan Narváez <prinick@ocrend.com>
 */

class Proyectos extends Models implements ModelsInterface {

    // Contenido del modelo... 


    /**
      * __construct()
    */
    public function __construct(RouterInterface $router = null) {
        parent::__construct($router);
    }

    /**
      * Obtiene elementos de Proyectos en la tabla `proyectos`
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(int $id = 0) {

        if (0 != $id) {
          # Traemos un proyecto
          $proj = $this->db->select('*','proyectos', "id_proyectos = '$id'", 'LIMIT 1');
        }else{
          # Traemos todos los proyectos
          $proj = $this->db->select('*','proyectos');
        }
        
        
        # Si no hay resultamos retornamos false
        if (false == $proj) {
          return false;
        }
        # Preparamos la consulta
        $prepare = $this->db->prepare("SELECT c.id_categorias,c.name_es FROM categoria_proyecto cp INNER JOIN categorias c ON cp.id_categoria = c.id_categorias WHERE cp.id_proyecto = ?");

        # Recorremos los proyectos
        foreach ($proj as $p) {
            # Ejecutamos la consulta preparada
            $prepare->execute(array($p['id_proyectos']));
            # Convertimos los datos en array
            $result = $prepare->fetchAll();

            # Creamos el nuevo array con los datos
            $real_proj[] = array(
              'id_proyectos' => $p['id_proyectos'],
              'titulo' => $p['titulo'],
              'short_desc_es' => $p['short_desc_es'],
              'short_desc_en' => $p['short_desc_en'],
              'content_es' => $p['content_es'],
              'content_en' => $p['content_en'],
              'portada' => $p['portada'],
              'logo' => $p['logo'],
              'categorias' => $this->category_in_string($result)
            );
        }
        return $real_proj;
    }
    /**
     * Convierte las categorias asociada a un proyecto en un string
     * @param array $categorias - Arreglo de categorias
     * @return String de categorias en formato categoria1, categoria2,...
     */
    final private function category_in_string(array $categorias) {        
        $cat_str = '';
        foreach ($categorias as $c) {
            $cat_str .= $c['id_categorias'] . ',';
        }
        $cat_str[strlen($cat_str) - 1] = ' ';
        return str_replace(',', ', ', $cat_str);
    }
    /**
     * Obtiene todas la categorias
     * @return array con todas las categorías
     */
    final public function getCategories() : array{
        return $this->db->select('*', 'categorias');
    }
    /**
     * Obtiene las imagenes de galeria de un proyecto
     * @param int $id - id del proyecto
     * @return array con cada archivo y su directorio
     */
    final public function getGallery(int $id) : array {

      $dir = './views/app/images/projects/'.$id.'/';
      
      return glob($dir . '{*.jpg,*.jpeg,*.png,*.gif}', GLOB_BRACE);
    }
        

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
    }
}