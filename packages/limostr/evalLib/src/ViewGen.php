<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 10/05/2018
 * Time: 13:50
 */

namespace Limostr\EvalLib;

use Limostr\EvalLib\CompEvaluation;
class ViewGen
{
        public $CompEval;
        private $_Model_Exp_Reg=array(
            "variable"=>"/(\{((@?|#?)[_A-Za-z0-9:]+)+\})/"
        );
        public function __construct(CompEvaluation &$CompEval)
        {
            $this->CompEval=$CompEval;

        }

        public function _InitValue(){

            if($this->CompEval->_Template){

                /**
                 *
                 */
                $Liste =$this->CompEval->_Template->getListe();
                if(is_array($Liste)){
                    foreach ($Liste as $key => $lg){
                        $type=$lg->getType();
                        switch($type){
                            case "EVAL":
                                $res=$this->evaluer($lg->getMallocForm());
                                $this->CompEval->_Template->setIn($key,"liste",$res);

                                break;
                            case "SET":
                                $res = $this->CompEval->lookForVariable($lg->getMallocForm());
                                $this->CompEval->_Template->setIn($key,"liste",$res);

                                break;
                            case "GET":
                                break;
                        }
                    }
                }


                /**
                 *
                 */

                $Ligne =$this->CompEval->_Template->getLigne();
                foreach ($Ligne as $key => $lg){
                    $type=$lg->getType();
                    switch($type){
                        case "EVAL":
                            $res=$this->evaluer($lg->getMallocForm());
                            $this->CompEval->_Template->setIn($key,"ligne",$res);

                            break;
                        case "SET":
                            $res = $this->CompEval->lookForVariable($lg->getMallocForm());
                            $this->CompEval->_Template->setIn($key,"ligne",$res);
                            $this->CompEval->_Trace[]=array(
                                "Comp"=>"View Template"
                                ,"Set"=>$key
                                ,   "Value"=>$res
                            );
                            break;
                        case "GET":
                            break;
                    }
                }



            }
        }

        public function evaluer($formuleEvaluated){
             echo $formuleEvaluated."<br>";
            $formule=$formuleEvaluated;
            while (preg_match($this->_Model_Exp_Reg['variable'],$formule,$matches)){
                if(isset($matches[0]) && !empty($matches[0])){
                    $UID=str_ireplace(array("}","{"),"",$matches[0]);
                    $var=$this->CompEval->lookForVariable($UID);
                    if(is_array($var)){
                        $var = implode(",",$var);
                    }
                    $formule=str_ireplace($matches[0],"$var",$formule);
                }

            }

            $use = "use Limostr\EvalLib\\MethodEval;";
            $res=null;
            //echo "\$res=$formule</br>" ;
            eval("$use;\$res=$formule;");

            $this->CompEval->_Trace[]=array(
                "Comp"=>"View Template"
                ,"Formule"=>$formuleEvaluated
                ,"Evaluation"=>$formule
            ,   "Resultat"=>$res
            );

            return $res;
        }

        public function genVue($VueTemplate){
            if($this->CompEval->_Template) {
                $ligne=[];

                $Liste = $this->CompEval->_Template->getListe();
                if(is_array($Liste)){
                    foreach ($Liste as $key => $lg) {
                        $v=$lg->getValue();

                        $VueTemplate = str_ireplace("{".$key.":@Value}",$v, $VueTemplate);
                    }
                }

                $Ligne = $this->CompEval->_Template->getLigne();
                foreach ($Ligne as $key => $lg) {
                    $v=$lg->getValue();

                    $VueTemplate = str_ireplace("{".$key.":@Value}",$v, $VueTemplate);

                }
            }
            return $VueTemplate;
        }

        public function genLigneArray(){
            if($this->CompEval->_Template) {
                $ligne=[];

                $Liste = $this->CompEval->_Template->getListe();
                if(is_array($Liste)) {
                    foreach ($Liste as $key => $lg) {
                        if (!empty($key)) {
                            $v = $lg->getValue();
							$v=empty($v) ? "0" : $v;
                            $L = $lg->getLabel();
                            $ordre = $lg->getOrdre();
                            $ligne[$key]=array("Label"=>$L,"Value"=>$v,"name"=>"$key","ordre"=>$ordre);
                        }

                    }
                }
                $Ligne = $this->CompEval->_Template->getLigne();
                foreach ($Ligne as $key => $lg) {
                    $v=$lg->getValue();
					$v=empty($v) ? "0" : $v;
                    $L=$lg->getLabel();
                    $ordre=$lg->getOrdre();
                    $ligne[$key]=array("Label"=>$L,"Value"=>$v,"name"=>"$key","ordre"=>$ordre);
                }
            }
            return $ligne;
        }

}