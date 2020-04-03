<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 09/05/2018
 * Time: 13:08
 *
 *
 *
 */

namespace evalLib\MetaRecords\RecordDB;
use evalLib\MetaRecords\Record;
use function PHPSTORM_META\elementType;

class RecordLoader implements Record
{
    public  $_Requests=[];
    private $_Table;
    private $_PKey;
    private $_ValuesLoaded;


    public function setInPrepare($key,$Varname,$value){
        $this->_Requests[$key]->setInPrepare($Varname,$value);
    }

    public function init($Record_Load){

        $this->_Table=isset($Record_Load['table']) ? $Record_Load['table'] : "";
        $this->_PKey=isset($Record_Load['pkey']) ? $Record_Load['pkey'] : "";

        if(isset($Record_Load['sql'])){
            foreach ($Record_Load['sql'] as $key => $sql){
                $LoderRecord = new \evalLib\MetaRecords\RecordDB\RecordSql();
                $LoderRecord->setSql(isset($sql['sqlstring']) ? $sql['sqlstring'] : "");
                $LoderRecord->setPrepare(isset($sql['prepare']) ? $sql['prepare'] : "");
                $LoderRecord->setPrepareInit(isset($sql['prepareInit']) ? $sql['prepareInit'] : "");
                $LoderRecord->setBind(isset($sql['bind']) ? $sql['bind'] : "");

                $SelectorType=new \evalLib\MetaRecords\RecordDB\RecordSelector();
                 if(isset($sql['SelectorType'])){
                     $SelectorType->Init($sql['SelectorType']);
                     $LoderRecord->setSelectorType($SelectorType);
                 }else{
                     $LoderRecord->setSelectorType(Null);
                 }

                $this->_Requests[$key]=$LoderRecord;
            }

        }


    }

    /**
     * @return mixed
     */
    public function getRequests()
    {
        return $this->_Requests;
    }

    /**
     * @param mixed $Requests
     */
    public function setRequests($Requests)
    {
        $this->_Requests = $Requests;
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
    public function getPKey()
    {
        return $this->_PKey;
    }

    /**
     * @param mixed $PKey
     */
    public function setPKey($PKey)
    {
        $this->_PKey = $PKey;
    }

    /**
     * @return mixed
     */
    public function getValuesLoaded()
    {
        return $this->_ValuesLoaded;
    }

    /**
     * @param mixed $ValuesLoaded
     */
    public function setValuesLoaded($ValuesLoaded)
    {
        $this->_ValuesLoaded = $ValuesLoaded;
    }
    public function toArray(){
        $Record_Load['table']=$this->_Table;
        $Record_Load['pkey']=$this->_PKey;
        foreach ($this->_Requests as $key => $datas){
            $Record_Load['sql'][$key]['sqlstring']=$datas->getSql();

            $Record_Load['sql'][$key]['prepare']=$datas->getPrepare();
            $Record_Load['sql'][$key]['bind']=$datas->getBind();


            if($datas->_SelectorType){
                $Record_Load['sql'][$key]['SelectorType']=$datas->_SelectorType->toArray();
            }else{
                $Record["Multiple"]=0;
                $Record["chose"]=[];
                $Record["bind"]=[];
                $Record["template"]=[];
                $Record_Load['sql'][$key]['SelectorType']=$Record;
            }

        }

        return $Record_Load;
    }
    public function toJson() {}
    public function FromJsonString(string $JsonString){}
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}
}