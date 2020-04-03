<?php
/**
 * ZF2 Application built by ZF2rapid
 *
 * @copyright (c) 2015 John Doe
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */


namespace SetupParameters\Form;

  use Laminas\Form\Form;

/**
 * InfoProDossierAr
 *
 * Provides the Cursusform form for the Enseignant Module
 *
 * @package Cursusform\Form
 */
class Cursusform extends Form
{

    /**
     * Generate form by adding elements
     */
    public function __construct($name = null)
    {
        parent::__construct($name);
        // add form elements and form configuration here
        $this->setInputFilter(new \SetupParameters\Filter\CursusFilter());
        $this->setName('Cursusform'); 

        $this->add(
            [
                'name' => 'id',
                'type' => 'text',
                'options' => [
                    'label' => 'Cursusform_id',
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'label',
                'type' => 'text',
                'options' => [
                    'label' => 'Cursusform_label',
                ],
                'attributes' => [
                    'class' => 'form-control',
                ],
            ]
        );

        

        $this->add(
            [
                'name' => 'save_Cursusform',
                'type' => 'Submit',
                'options' => [
                ],
                'attributes' => [
                    'value' => 'Cursusform_action_save',
                    'id' => 'save_Cursusform',
                    'class' => 'btn btn-success',
                ],
            ]
        );

        // add form elements and form configuration here
    }


}
