<?php   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;


class PaymentTypeBankTransferForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('PaymentTypeBankTransfer');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
        
        
        $file = new Element\File('image-file');
        $file->setLabel('Payment Type Logo')
             ->setAttribute('id', 'image-file');
        $this->add($file);
 
        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary',
            ),
        ));
    }
}