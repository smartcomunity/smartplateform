<?php

namespace Models\Smarteducation\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Evalcompmodel implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
			'name'     => 'id',
			'required' => true,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 55,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'NameComp',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 155,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'EvalContext_id',
			'required' => true,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
			'validators' => array(
			array(
			'name'    => 'StringLength',
			'options' => array(
			'encoding' => 'utf8',
			'min'      => 1,
			'max'      => 55,
				),
				),
				),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'DescComp',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
				)));
				            $inputFilter->add($factory->createInput(array(
			'name'     => 'EvalGlobalModel',
			'required' => false,
			'filters'  => array(
			array('name' => 'StripTags'),
			array('name' => 'StringTrim'),
			),
				)));
				 

            $this->inputFilter = $inputFilter;        
        }

        return $this->inputFilter;
    }
}