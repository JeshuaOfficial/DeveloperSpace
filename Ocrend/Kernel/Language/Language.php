<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ocrend\Kernel\Language;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Clase que manipula el lenguaje actual de la página.
 *
 * @author Brayan Narváez <prinick@ocrend.com>
*/

class Language {

	/**
      * Lenguaje por defecto del sitio
      *
      * @var string
    */
    const DEFAULT_LANG = 'es';

    /**
      * Lenguajes existentes
      *
      * @var array
    */
    const LANGUAGES = [
        'es' => 'Español', # Español
        'en' => 'English' # Inglés
    ];
    /**
      * Define el lenguaje 
      *
      * @return void
    */
    public function setLanguage() {
    	global $session, $http;
    	if (null != ($lang = $http->query->get('lang'))) {
    		if (array_key_exists($lang, self::LANGUAGES)) {
    			$session->set('web_language', $lang);
    		}
    	}
    }

    /**
      * Devuelve el lenguaje actual del sitio
      *
      * @return string
    */
    public function getLanguage() {
    	global $session;

    	if (null === $session->get('web_language')) {
    		return self::DEFAULT_LANG;
    	}

    	return $session->get('web_language');
    }

    /**
      * Carga el fichero de lenguaje correspondiente al controlador
      *
      * @return array con la información
    */
   	public function loadLanguage(string $controller) : array {
        $route = API_INTERFACE . 'app/languages/' . $controller . '/' . $this->getLanguage() . '.yml';
        if(is_readable($route)) {
            return Yaml::parse(file_get_contents($route));
        }

        return Yaml::parse(file_get_contents(API_INTERFACE . 'app/languages/error/' . $this->getLanguage() . '.yml'));
    }
}