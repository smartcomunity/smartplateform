<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 14/05/2018
 * Time: 13:05
 */

/**
 * 'Multiple'=>0
,'SqlSequence'=>"s1"
,'chose'=>array(
'typediplome'=>array('IN'=>array(
'Fondamentale',
'Appliqué',
'DUT'
))
)
 */
namespace evalLib\MetaRecords\RecordDB;
use evalLib\MetaRecords\Record;

class RecordSelector implements Record
{
    private $_Multiple;
    private $_Chose;
    private $_Bind;
    private $_Template;

    public function Init($Record){
        $this->_Multiple=$Record["Multiple"];
        $this->_Chose   =$Record["chose"];
        $this->_Bind    =$Record["bind"];
        $this->_Template=$Record["template"];
    }

    /**
     * @return mixed
     */
    public function getBind()
    {
        return $this->_Bind;
    }

    /**
     * @param mixed $Bind
     */
    public function setBind($Bind)
    {
        $this->_Bind = $Bind;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->_Template;
    }

    /**
     * @param mixed $Template
     */
    public function setTemplate($Template)
    {
        $this->_Template = $Template;
    }

    /**
     * @return mixed
     */
    public function getMultiple()
    {
        return $this->_Multiple;
    }

    /**
     * @param mixed $Multiple
     */
    public function setMultiple($Multiple)
    {
        $this->_Multiple = $Multiple;
    }



    /**
     * @return mixed
     */
    public function getChose()
    {
        return $this->_Chose;
    }

    /**
     * @param mixed $chose
     */
    public function setChose($Chose)
    {
        $this->_Chose = $Chose;
    }

    public function toArray(){

        $Record["Multiple"]=$this->_Multiple;
        $Record["chose"]=$this->_Chose;
        $Record["bind"]=$this->_Bind;
        $Record["template"]=$this->_Template;

        return $Record;
    }
    public function toJson() {}
    public function FromJsonString(string $JsonString){}
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}
}
