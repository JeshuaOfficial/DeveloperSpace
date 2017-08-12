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
use Ocrend\Kernel\Helpers\{Strings,Emails};

/**
 * Modelo Contact
 *
 * @author DevSystemVzla <devsystemvzla@gmail.com>
 */

class Contact extends Models implements ModelsInterface {

    /**
     * Nombre del usuario
     * @var String
     */
    private $nombre;

    /**
     * Email del usuario
     * @var String
     */
    private $email;

    /**
     * Mensaje del usuario
     * @var String
     */
    private $mensaje;
    
    /**
     * Email general
     * @var String
     */
    private $general;



    /**
      * __construct()
    */
    public function __construct(RouterInterface $router = null) {
        parent::__construct($router);
    }

    /**
     * Obtiene los datos de contacto
     * @return array con los datos
     */
    final public function getContactInfo() {
        $contact = $this->db->select('latitud,longitud,address,como,phone_1,phone_2,emails,work', 'contact', "id_contact = '1'",'LIMIT 1')[0];
        $contact['address'] = json_decode($contact['address'],true);
        $contact['como'] = json_decode($contact['como'],true);
        $contact['emails'] = json_decode($contact['emails'],true);
        $contact['work'] = json_decode($contact['work'],true);
        $contact['phone_1'] = $this->phone_format( $contact['phone_1'] );
        $contact['phone_2'] = $this->phone_format( $contact['phone_2'] );
        return $contact;
    } 
    /**
     * Convierte un número de teléfono en un formato (xxxx) xxx-xxxx
     * @param  $phone: número de teléfono a convertir
     * @return el teléfono en el nuevo formato
     */
    final private function phone_format($phone) : string{
        $long_phone = strlen($phone);
        if ($long_phone == 10) {
            $code = substr($phone, 0,3);
            $mid_number = substr($phone, 3,3);
            $r = '[0-9]{3}';
        }else{
            $code = substr($phone, 0,4);
            $mid_number = substr($phone, 4,3);
            $r = '[0-9]{4}';
        }

        return preg_replace('#^'.$r.'[0-9]{3}#', '('.$code.') '.$mid_number.'-', $phone);
    }

    /**
     * Control de errores
     * @return void
     */
    final private function Errors() {
        global $http;
        # Guardamos datos
        $this->nombre = $http->request->get('nombre');
        $this->email = $http->request->get('email');
        $this->mensaje = $http->request->get('mensaje');
        $this->general = $this->db->select('email_general', 'contact', "id_contact = '1'", 'LIMIT 1')[0][0];

        # Todos los campos son obligatorios
        if ( !$this->functions->all_full( $http->request->all() ) ) {
           throw new ModelsException('Debes llenar todos los campos.');
        }
        # Validación del formato del email
        if (!Strings::is_email($this->email)) {
            throw new ModelsException('El email debe tener un formato válido.');
        }
    }

    /**
     * Envia un mensaje al email general de la página
     * @return array con exito o fracaso al enviar mensaje
     */

    final public function Contact() {
        global $http,$config;
        try {

            # Errores
            $this->Errors();

            # Creamos una plantilla para el mensaje
            $HTML = Emails::plantilla(
                '<h5 style="font-weight: bold;">Datos de la persona:</h5>
                <b>Nombre: </b> '.$this->nombre . '<br>
                <b>Email: </b> '.$this->email.'
                <h5 style="font-weight: bold;">Mensaje:</h5>
                '.nl2br($this->mensaje)
            );

            $email = Emails::send_mail([$this->general => $config['site']['name']], $HTML, 'Mensaje de contacto');

            if (false === $email) {
                return array('success' => 0, 'message' => 'No se pudo enviar el mensaje, intentelo de nuevo mas tarde.');
            }

            return array('success' => 1, 'message' => 'Mensaje enviado de forma exitosa.');
        } catch (ModelsException $e) {
            return array('success' => 0, 'message' => $e->getMessage());
        }
        
    }


    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
    }
}