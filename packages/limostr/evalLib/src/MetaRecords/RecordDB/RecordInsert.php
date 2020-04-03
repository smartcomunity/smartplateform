<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 13/05/2018
 * Time: 19:59
 */

namespace evalLib\MetaRecords\RecordDB;

use evalLib\MetaRecords\Record;

class RecordInsert implements Record
{

    private $_Bind;
    private $_Table;
    private $_UpdateCondition;


    public function init($RecordInsert){
        $this->_Bind=$RecordInsert['bind'];
        $this->_Table=$RecordInsert['table'];
        $this->_UpdateCondition=$RecordInsert['updateCondition'];
    }

    public function setInBindData($keytype,$value){

    }

    public function setInBindRecordsData(){

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
    public function getTable()
    {
        return $this->_Table;
    }

    /**
     * @param mixed $Table
     */
    public function setTable($Table)
    {
        $this->_Table = $Table;
    }

    /**
     * @return mixed
     */
    public function getUpdateCondition()
    {
        return $this->_UpdateCondition;
    }

    /**
     * @param mixed $UpdateCondetion
     */
    public function setUpdateCondition($UpdatiCondetion)
    {
        $this->_UpdateCondition = $UpdatiCondition;
    }


    public function toArray(){

        $RecordInsert['bind']=$this->_Bind;
        $RecordInsert['table']=$this->_Table;
        $RecordInsert['updateCondition']=$this->_UpdateCondition;

        return $RecordInsert;
    }
    public function toJson() {}
    public function FromJsonString(string $JsonString){}
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}
}