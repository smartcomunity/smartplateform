<?php
namespace Limostr\EvalLib\MetaRecords;

/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 08/05/2018
 * Time: 10:51
 */

/*
 *
 * "BS"=>array(
            'Name'=>"BS"
            ,'Label'=>"Bonus Session"
            ,'Formule'=>array(
                "F1"=>array('toEval'=>"{@Parent:@AutreInformations:session}=='Principale'","score"=>1,"description"=>"","decision"=>"")
                ,"F2"=>array('toEval'=>"{@Parent:@AutreInformations:session}=='Rattrapage'","score"=>0,"description"=>"","decision"=>"")
            )
            ,'Score'=>""
            ,'Poid'=>""
            ,'description'=>""
            ,'decision'=>""
        ),
 *
 *
 */

class RecordModelEval implements Record
{
    private $_Name="";
    private $_Label="";
    private $_Formule=array();
    private $_Score="";
    private $_Poid;
    private $_description="";
    private $_decission="";


    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_Name;
    }

    /**
     * @param mixed $Name
     */
    public function setName($Name)
    {
        $this->_Name = $Name;
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
    public function getFormule()
    {
        return $this->_Formule;
    }

    /**
     * @param mixed $Formule
     */
    public function setFormule($Formule)
    {
        $this->_Formule = $Formule;
    }

    public function constructFormule($ListFormule){

            foreach ($ListFormule  as $keyFormule => $Formule){
                $RecordForm=new RecordFormule();
                $RecordForm->setName($keyFormule);
                $RecordForm->setNature($Formule['nature']);
                $RecordForm->setScore($Formule['score']);
                $RecordForm->setDescription($Formule['description']);
                $RecordForm->setToEval($Formule['toEval']);
                $RecordForm->setType($Formule['type']);
                $RecordForm->setDefault($Formule['default']);
                $RecordForm->setBind($Formule['bind']);
                $this->_Formule[$keyFormule]=$RecordForm;
            }

    }
    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->_Score;
    }

    /**
     * @param mixed $Score
     */
    public function setScore($Score)
    {
        $this->_Score = $Score;
    }

    /**
     * @return mixed
     */
    public function getPoid()
    {
        return $this->_Poid;
    }

    /**
     * @param mixed $Poid
     */
    public function setPoid($Poid)
    {
        $this->_Poid = $Poid;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @return mixed
     */
    public function getDecission()
    {
        return $this->_decission;
    }

    /**
     * @param mixed $decission
     */
    public function setDecission($decission)
    {
        $this->_decission = $decission;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->_Affiche;
    }

    /**
     * @param mixed $Affiche
     */
    public function setAffiche($Affiche)
    {
        $this->_Affiche = $Affiche;
    }


    public function ToNode(){
        $tree["key"]= $this->_Name;
        $tree["title"]= $this->_Label;
        $tree["tooltip"]= $this->_Label;
        $tree["folder"]= "false";

        $tree["iconclass"]="fa fa-calendar";

        foreach ($this->_Formule as $key => $f){
            $tree['children'][]=$f->ToNode();
            $tree["folder"]="true";
        }


        return $tree;
    }
    public function toJson() {}

    public function toArray(){

        $TableCompRecEval['Name']=$this->_Name;
        $TableCompRecEval['Label']=$this->_Label;
        foreach ($this->_Formule as $key_F => $Formule){
            $TableCompRecEval['Formule'][$key_F]=$Formule->toArray();
        }

        $TableCompRecEval['Score']=$this->_Score;
        $TableCompRecEval['Poid']=$this->_Poid;
        $TableCompRecEval['description']=$this->_description;
        $TableCompRecEval['decission']=$this->_decission;
        return $TableCompRecEval;
    }

    public function FromJsonString(string $JsonString){}
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}

}