<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 09/05/2018
 * Time: 10:07
 */

namespace Limostr\EvalLib\MetaRecords;


class FormStructer
{
    private $_Action="";
    private $_Method="POST";
    private $_Id="IdForm";
    private $_Name="NameForm";
    private $_Class="form";
    private $_other="";

    /**
     * @return string
     */
    public function getOther(): string
    {
        return $this->_other;
    }

    /**
     * @param string $other
     */
    public function setOther(string $other): void
    {
        $this->_other = $other;
    }



    public function __construct($Action="",$Method="",$Id="",$Name="",$Class=Null,$other=null)
    {
       if(!empty($Action)){
        $this->_Action=$Action;
       }
        if(!empty($Method)){
            $this->_Method=$Method;
        }
        if(!empty($Id)){
            $this->_Id=$Id;
        }
        if(!empty($Name)){
            $this->_Name=$Name;
        }
        if(is_array($Class) && count($Class)>0){
           foreach ($Class as $c){
               $this->_Class.=" $c";
           }
        }elseif(!empty($Class) && $Class instanceof string){
            $this->_Class.=" $Class";
        }

        if(is_array($other) && count($other)>0){
            foreach ($other as $key => $c){
                $this->_other.="$key=\"$c\"";
            }
        }
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->_Action;
    }

    /**
     * @param mixed $Action
     */
    public function setAction($Action): void
    {
        $this->_Action = $Action;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->_Method;
    }

    /**
     * @param mixed $Method
     */
    public function setMethod($Method): void
    {
        $this->_Method = $Method;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id): void
    {
        $this->_Id = $Id;
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
    public function setName($Name): void
    {
        $this->_Name = $Name;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return "class=\"".$this->_Class."\"";
    }

    /**
     * @param mixed $Class
     */
    public function setClass($Class): void
    {
        $this->_Class = $Class;
    }

    /**
     * @param mixed $Class
     */
    public function addClass($Class): void
    {
        $this->_Class.= " $Class";
    }


    public function addAttrib($name,$value){
        $this->_other.= "$name =\"$value\"";
    }

    public function __toString(){
        $class=$this->getClass();
        $other=$this->getOther();
        return "<form  action=\"".$this->getAction()."\" method=\"".$this->getMethod()."\" name=\"".$this->getName()."\" id=\"".$this->getId()."\" $class $other>";

    }


}