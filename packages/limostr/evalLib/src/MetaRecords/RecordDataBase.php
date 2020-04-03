<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 14/05/2018
 * Time: 14:29
 */

namespace Limostr\EvalLib\MetaRecords;
use Limostr\EvalLib\MetaRecords\Record;

class RecordDataBase implements Record
{
    public $_Init;

    public $_Record_Load;
    public $_Record_Insert;

    public function Init($RecordDB){
        $this->_Record_Load=new  \Limostr\EvalLib\MetaRecords\RecordDB\RecordLoader();
        $this->_Record_Load->init(isset($RecordDB['loader']) ? $RecordDB['loader']:array() );

        foreach ($RecordDB['insert'] as $keyinsert => $valinsert){
            $this->_Record_Insert[$keyinsert]=new \Limostr\EvalLib\MetaRecords\RecordDB\RecordInsert();
            $this->_Record_Insert[$keyinsert]->init($valinsert);

        }
        $this->_Init=isset($RecordDB['init']) ? $RecordDB['init'] : "";

    }



    /**
     * @return mixed
     */
    public function getCompEval()
    {
        return $this->CompEval;
    }

    /**
     * @param mixed $CompEval
     */
    public function setCompEval($CompEval)
    {
        $this->CompEval = $CompEval;
    }

    /**
     * @return mixed
     */
    public function getInit()
    {
        return $this->_Init;
    }

    /**
     * @param mixed $Init
     */
    public function setInit($Init)
    {
        $this->_Init = $Init;
    }

    /**
     * @return mixed
     */
    public function getRecordLoad() : \Limostr\EvalLib\MetaRecords\RecordDB\RecordLoader
    {
        return $this->_Record_Load;
    }

    /**
     * @param mixed $Record_Load
     */
    public function setRecordLoad($Record_Load)
    {
        $this->_Record_Load = $Record_Load;
    }

    /**
     * @return mixed
     */
    public function getRecordInsert()
    {
        return $this->_Record_Insert;
    }

    /**
     * @param mixed $Record_Insert
     */
    public function setRecordInsert($Record_Insert)
    {
        $this->_Record_Insert = $Record_Insert;
    }

    public function toJson() {}
    public function FromJsonString(string $JsonString){}
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}

    public function toArray(){

        $RecordDB['loader']=$this->_Record_Load->toArray();

        foreach ($this->_Record_Insert as $key_Insert => $isertdata){
            $RecordDB['insert'][$key_Insert]=$isertdata->toArray();
        }

        $RecordDB['init']=$this->_Init;
        return $RecordDB;

    }
}