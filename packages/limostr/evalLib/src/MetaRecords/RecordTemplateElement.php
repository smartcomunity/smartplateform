<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 15/05/2018
 * Time: 12:13
 */

namespace Limostr\EvalLib\MetaRecords;


class RecordTemplateElement
{
    private $_Type;
    private $_Value;
    private $_Label;
    private $_ordre;
    private $_MallocForm;
    public function init($Record_Template){

        $this->_Type=isset($Record_Template['Type']) ? $Record_Template['Type'] : "";
        $this->_MallocForm=isset($Record_Template['Malloc']) ? $Record_Template['Malloc'] : "";
        $this->_Value=isset($Record_Template['Value']) ? $Record_Template['Value'] : "";
        $this->_Label=isset($Record_Template['Label']) ? $Record_Template['Label'] : "";
        $this->_Label=isset($Record_Template['Label']) ? $Record_Template['Label'] : "";
        $this->_ordre=isset($Record_Template['ordre']) ? $Record_Template['ordre'] : "";


    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_Type;
    }

    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->_Type = $Type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_Value;
    }

    /**
     * @param mixed $Value
     */
    public function setValue($Value)
    {
        $this->_Value = $Value;
    }

    /**
     * @return mixed
     */
    public function getMallocForm()
    {
        return $this->_MallocForm;
    }

    /**
     * @param mixed $MallocForm
     */
    public function setMallocForm($MallocForm)
    {
        $this->_MallocForm = $MallocForm;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->_Label;
    }

    /**
     * @param mixed $Label
     */
    public function setLabel($Label)
    {
        $this->_Label = $Label;
    }

    /**
     * @return mixed
     */
    public function getOrdre()
    {
        return $this->_ordre;
    }

    /**
     * @param mixed $ordre
     */
    public function setOrdre($ordre)
    {
        $this->_ordre = $ordre;
    }




}