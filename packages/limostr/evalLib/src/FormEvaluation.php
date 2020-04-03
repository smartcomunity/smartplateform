<?php

namespace Limostr\EvalLib;
use Limostr\EvalLib\MetaRecords\FormStructer;
use Limostr\EvalLib\MetaRecords\RecordForm;

class FormEvaluation{

    private $_CompEval;
    private $form="";
    public $FormAttrib;
    public $_TableValueInit;
    private $_Has_Submit=false;
    public function __construct(CompEvaluation $EvalCom,FormStructer $FormData=Null)
    {
        $this->_CompEval=$EvalCom;
        if(!$FormData){
            $this->FormAttrib=new FormStructer();
        }else{
            $this->FormAttrib=$FormData;
        }

        $this->FormContruction();
    }

    public function InitFromBind(){
        if($EvalCom) {
            foreach ($EvalCom as $key => $CompToEval) {
                if ($CompToEval->_RecordEval->getAffiche()) {

                }
            }
        }
    }

    /**
     * @return FormStructer
     */
    public function getFormAttrib(): FormStructer
    {
        return $this->FormAttrib;
    }

    /**
     * @param FormStructer $FormAttrib
     */
    public function setFormAttrib(FormStructer $FormAttrib)
    {
        $this->FormAttrib = $FormAttrib;
    }

    public function FormContruction($EvalCom=Null){

        if($EvalCom){
            foreach ($EvalCom as $key => $CompToEval){
                if(isset($CompToEval->_RecordEval) && $CompToEval->_RecordEval->getAffiche()){
                    $this->form.="<section>
                        <h3>".$CompToEval->_RecordEval->getLabel()."</h3>
                        <article>
                        <h4>".$CompToEval->_RecordEval->getDescription()."</h4>";
                }else{
                    $this->form.="<section>
                        <h3> </h3>
                        <article>
                        <h4> </h4>";
                }


                $this->FormElmentContruct($CompToEval);
                if(is_array($CompToEval->_SubComp) && count($CompToEval->_SubComp)) {
                    $this->FormContruction($CompToEval->_SubComp);
                }

                $this->form.="</article></section>";

            }
        }else{

            if($this->_CompEval->_RecordEval->getAffiche()){
                $this->form.="<section>
                        <h3>".$this->_CompEval->_RecordEval->getLabel()."</h3>
                        <article>
                        <h4>".$this->_CompEval->_RecordEval->getDescription()."</h4>";
            }else{
                $this->form.="<section>
                        <h3> </h3>
                        <article>
                        <h4> </h4>";
            }
            $this->FormElmentContruct($this->_CompEval);
            if(is_array($this->_CompEval->_SubComp) && count($this->_CompEval->_SubComp)) {
                $this->FormContruction($this->_CompEval->_SubComp);
            }
            $this->form.="</article></section>";
        }
    }
    private function FormElmentContruct(CompEvaluation $formElts){
        if(is_array($formElts->_form) && count($formElts->_form)){
            $this->form.="<fieldset>
                            <legend>".$formElts->_RecordEval->getLabel()."</legend>";
            foreach ($formElts->_form as $key => $elt){
                $_InitValue=$this->_CompEval->lookForVariable($key);
                if(empty($_InitValue)){
                    $other=$elt->getOther();
                    if(isset($other["value"])){
                        $_InitValue=$other["value"];
                    }
                }
                switch ($elt->getType()){
                    case 'select':
                        $this->form.=$this->setSelect($elt,$_InitValue);
                        break;
                    case "text":

                        $this->form.=$this->setText($elt,$_InitValue);
                        break;
                    case "textarea":
                        $this->form.=$this->setTextarea($elt,$_InitValue);
                        break;
                    case "submit":
                        $this->form.=$this->setSubmit($name,$id,$label);
                        break;
                    case "hidden":
                        $this->form.=$this->setHidden($elt,$_InitValue);
                        break;

                    default:
                        $this->form.=$this->setOtherInput($elt,$_InitValue);
                    break;
                }

            }
            $this->form.="</fieldset>";
        }
    }
    public function setSelect(RecordForm $elt,$_InitValue){
        $class=$this->DetectClass($elt->getClass());
        $other=$this->DetectOtherAttrib($elt->getOther());
		$select = "<div class=\"form-group has-feedback input-group\">";
			$select.="<label for=\"".$elt->getName()."\">".$elt->getLabel()."</label>";
			$select .="<select class=\"form-control\" name=\"".$elt->getName()."\" id=\"".$elt->getId()."\" $other $class>";
			$list=$elt->getList();
			foreach ($list as $key=>$val){
				$selected = !empty($_InitValue) && $key==$_InitValue ? "Selected=\"selected\"" :"";
				$select.="<option value=\"$key\" $selected>$val</option>";
			}

			$select.="</select>";
		$select.="</div>";
        return $select;
    }

    public function setText(RecordForm $elt,$_InitValue){
        $class=$this->DetectClass($elt->getClass());
        $other=$this->DetectOtherAttrib($elt->getOther());
		$select = "<div class=\"form-group has-feedback input-group\">";
        $select.="<label for=\"".$elt->getName()."\">".$elt->getLabel()."</label>";
        $select .="<input class=\"form-control\" type=\"text\" value=\"$_InitValue\" name=\"".$elt->getName()."\" id=\"".$elt->getId()."\" $class $other>";
        $select.="</div>";
		
		return $select;
    }

    public function setHidden(RecordForm $elt,$_InitValue){
        $class=$this->DetectClass($elt->getClass());
        $other=$this->DetectOtherAttrib($elt->getOther());

         $input ="<input type=\"hidden\" value=\"$_InitValue\" name=\"".$elt->getName()."\" id=\"".$elt->getId()."\" $class $other>";
        return $input;
    }
    public function setOtherInput(RecordForm $elt,$_InitValue){

        $class=$this->DetectClass($elt->getClass());
        $other=$this->DetectOtherAttrib($elt->getOther());
		$input = "<div class=\"form-group has-feedback input-group\">";
        $input.="<label for=\"".$elt->getName()."\">".$elt->getLabel()."</label>";

        $input .="<input class=\"form-control\" type=\"".$elt->getType()."\" value=\"$_InitValue\" name=\"".$elt->getName()."\" id=\"".$elt->getId()."\" $class $other>";
       $input.="</div>";
	   return $input;
    }

    public function setTextarea(RecordForm $elt,$_InitValue){
        $class=$this->DetectClass($elt->getClass());
        $other=$this->DetectOtherAttrib($elt->getOther());
		$input = "<div class=\"form-group has-feedback input-group\">";
        $input.="<label for=\"".$elt->getName()."\">".$elt->getLabel()."</label>";

        $input .="<textarea class=\"form-control\" type=\"text\" name=\"".$elt->getName()."\" id=\"".$elt->getId()."\" $other $class>$_InitValue</textarea>";
	    $input.="</div>";
		return $input;
    }

    public function setSubmit($name,$id,$label ){

        $this->_Has_Submit=true;
        return "<input class=\"btn btn-success\" type=\"submit\" value=\"$label\" name=\"$name\" id=\"$id\" >";
    }

    private function DetectClass($options){
        $class="";
        if(is_array($options)){
            foreach ($options as $c){
                $class.=" $c";
            }
        }else{
            $class.=" $options";
        }


        if(!empty($class)){
            $class=" class=\"$class\"";
        }
        return $class;
    }


    private function DetectOtherAttrib($options){
        $other="";

        if(is_array($options)){
            foreach ($options as $key=>$c){
                $other.="$key=\"$c\"";
            }
        }


        return $other;
    }

    public function openTag(){
        $class=$this->FormAttrib->getClass();
        $other=$this->FormAttrib->getOther();
        return $this->FormAttrib;
       // return "<form $other $class action=\"".$this->FormAttrib->getAction()."\" method=\"".$this->FormAttrib->getMethod()."\" name=\"".$this->FormAttrib->getName()."\" class=\"".$this->FormAttrib->getClass()."\">";
    }

    public function closeTag(){
        $closeForm="";
        if(!$this->_Has_Submit){
            $closeForm=$this->setSubmit("submit","submit","Enregistrer");
        }
        $closeForm.="</form>";
        return $closeForm;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $form = $this->openTag();
        $form.=$this->form;

        $form.=$this->closeTag();


        return $form;

    }

}