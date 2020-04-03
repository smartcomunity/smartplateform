<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 08/05/2018
 * Time: 13:25
 */

namespace Limostr\EvalLib\MetaRecords;


class RecordEval implements Record
{
    private $_Name;
    private $_Label;
    private $_Formule=array();
    private $_Score;
    private $_Poid;
    private $_description;
    private $_decission;
    private $_AutreInformations;//JsonStructur -->Object Notation : StdClass
    private $_Model ;//CompModel
    private $_Affiche="";
    private $_Parameters;

    private $_SubComp=array();


    /**
     * @return string
     */
    public function getAffiche()
    {
        return $this->_Affiche;
    }

    /**
     * @param string $Affiche
     */
    public function setAffiche($Affiche)
    {
        $this->_Affiche = $Affiche;
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
    public function getAutreInformations()
    {
        return $this->_AutreInformations;
    }

    /**
     * @param mixed $AutreInformations
     */
    public function setAutreInformations($AutreInformations)
    {
        $this->_AutreInformations = $AutreInformations;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->_Model;
    }

    /**
     * @param mixed $Model
     */
    public function setModel($Model)
    {
        $this->_Model = $Model;
    }
    public function getSubComp(string $varname)
    {
        return $this->_SubComp[$varname];
    }

    /**
     * @param array $SubComp
     */
    public function setSubComp( $SubComp)
    {
        $this->_SubComp[$SubComp->_Var] = $SubComp;
    }

    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->_Parameters;
    }

    /**
     * @param mixed $Parameters
     */
    public function setParameters($Parameters)
    {
        $this->_Parameters = $Parameters;
    }


    public function __toArray() : array {
       return array(
            'Name'=>$this->_Name
            ,'Label'=>$this->_Label
            ,'Formule'=>$this->_Formule
            ,'Score'=>$this->_Score
            ,'Poid'=>$this->_Poid
            ,'description'=>$this->_description
            ,'decission'=>$this->_decission
            ,'AutreInformations'=>$this->_AutreInformations
            ,'Model'=>$this->Model
        );
    }

    public function toJson() {}

    public function FromJsonString(string $JsonString){
        $JsonDecode = json_decode($JsonString);

        $this->_Name=isset($JsonDecode['Name']) ? $JsonDecode['Name'] : "";
        $this->_Label=isset($JsonDecode['Label']) ? $JsonDecode['Label'] : "";
        $this->_Formule=isset($JsonDecode['Formule']) ? $JsonDecode['Formule'] : "";
        $this->_Score=isset($JsonDecode['Score']) ? $JsonDecode['Score'] : "";
        $this->_Poid=isset($JsonDecode['Poid']) ? $JsonDecode['Poid'] : "";
        $this->_description=isset($JsonDecode['description']) ? $JsonDecode['description'] : "";
        $this->_decission=isset($JsonDecode['decission']) ? $JsonDecode['decission'] : "";
        $this->_AutreInformations=isset($JsonDecode['AutreInformations']) ? $JsonDecode['AutreInformations'] : "";
        $this->_Model=isset($JsonDecode['Model']) ? $JsonDecode['Model'] : "";

    }
    public function FromArray($JsonString){}
    public function HasAttribute($attribute){}
    public function toArray(){}

}