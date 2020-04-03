<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 08/05/2018
 * Time: 13:40
 */

namespace Limostr\EvalLib;
use Limostr\EvalLib\MetaRecords\RecordFormule;
use Limostr\EvalLib\MethodEval;

/**
 * Class Evaluateur
 * @package Limostr\EvalLib
 *
 *
 * ([A-Z]{3,})(\(\{@[a-zA-A0-9:_]{2,}\}\))
 *
 * detection variable           : (\(\{@[a-zA-A0-9:_]{2,}\}\))
 * detection function           : ([A-Z]{3,})
 * detection detection result   : ([a-zA-A0-9:_]+)
 *
 */
class Evaluateur
{
    private $CompEval;
    private $function="([A-Z]{3,})(\(\{@[A-Za-z0-9:]+\}\)|\(\{@[A-Za-z0-9:]+\},\d+\))";
    private $_Model_Exp_Reg=array(
        "function"=>"/([A-Z]{3,})(\(\{@[_A-Za-z0-9:]+\}\)|\(\{@[A-Za-z0-9:]+\},\d+\))/"
        ,"variableOld"=>"/(\{((@?|#?)[_A-Za-z0-9:]+)+\})/"
		,"variable"=>"(\{[_A-Za-z0-9:@*#*]+\})"
         ,"function2"=>"/([A-Z]{3,})()/"
        ,"functionOnly"=>"([A-Z]{3,})"
        ,"result"=>"([a-zA-A0-9:_]+)"
        ,"All"=>"([A-Z]{3,})(\(\{@[a-zA-A0-9:_]{2,}\}\))"
		
		///-----Detection des function
		,"Methode"=>"(\{+[A-Za-z0-9:*\s*]+\([A-Za-z0-9\s*:*\*\[*\]*\#\{*\}*\@\+\/*]*\)\}+)"
		,"params"=>"(\([A-Za-z0-9:\s*\*\[*\]*\#\{*\}*\@\+\/*]*\))"
        );


    public function __construct(CompEvaluation $CompEval=null)
    {
        $this->CompEval=$CompEval;
    }

    public function Evaluation(CompEvaluation &$PComp=Null){
		try{
				if(!$PComp){
					$PComp=$this->CompEval;
				}

				if(isset($PComp->_SubComp) && is_array($PComp->_SubComp) && count($PComp->_SubComp)>0){

					foreach ($PComp->_SubComp as $key=>$cmp){
						$this->Evaluation($PComp->_SubComp[$key]);
					}

				}

				if(isset($PComp->_Model)){
					foreach ($PComp->_Model as $KeyModel => $FormuleModel){
						$Formules=$FormuleModel->getFormule();
						$res=0;
						foreach ($Formules as $keyFormModel => $Formule){
						  //  echo $Formule->getNature();
							if ($Formule->getNature()=="else" && !$res){
								$res=$this->detectFunction($Formule);
							}elseif ($Formule->getNature()!="else"){
								$res=$this->detectFunction($Formule);
							}
						}
					}

				}

				if(isset($PComp->_Formule)){
					$res=0;
					foreach ($PComp->_Formule as $KeyFormule => $Formule){
						if ($Formule->getNature()=="else" && !$res){
							$res=$this->detectFunction($Formule);
						}elseif ($Formule->getNature()!="else"){
							$res=$this->detectFunction($Formule);
						}
					 }
				}
		 } catch (Zend_Exception $e) { 
			 echo $e->getMessage(); 
			$this->__trace();
            
        }
        //print_r($res);
    }
	
	public function ComplexResultCondition($toEval,$Type="arithmetique"){
		$formuleEvaluated=$toEval;

		$matchExcept=preg_match($this->_Model_Exp_Reg['Methode'],$formuleEvaluated,$matchesformule);
		$this->CompEval->_Trace[]=array(
			"Formule"=>$formuleEvaluated
			,"desc"=>"Detection fonction "
            ,"Evaluation"=>$matchesformule
        ); 
			
			if($matchExcept){
				$hasparams=preg_match($this->_Model_Exp_Reg['params'],$formuleEvaluated,$params);
				$this->CompEval->_Trace[]=array(
					"Formule"=>$formuleEvaluated
					,"desc"=>"Detection parametre "
					,"Evaluation"=>$params
				); 

				if($hasparams){
					 
					$PComp=$this->CompEval;
					$SubCompName=[];
					if(isset($PComp->_SubComp) && is_array($PComp->_SubComp) && count($PComp->_SubComp)>0){ 
						 $SubCompName=array_keys($PComp->_SubComp);
					}	
					$compInitial="(\{+[A-Za-z0-9\s:#]*)";
						$variable="(\{[_A-Za-z0-9:@*#*]+\})";
					$hasparamsInitial=preg_match($compInitial,$formuleEvaluated,$Initial);
					$initialP=str_ireplace("{","",$Initial[0]);  
						$this->CompEval->_Trace[]=array(
							"Formule"=>$formuleEvaluated
							,"desc"=>"Detection initial path sub comp variable value "
							,"Evaluation"=>$Initial
						); 
						
					foreach($params as $v){
						$paramsTemplate=$v;
						preg_match_all($variable,$v,$vars);
						//print_r($vars);
						$this->CompEval->_Trace[]=array(
							"Formule"=>$formuleEvaluated
							,"desc"=>"Detection variables "
							,"Evaluation"=>$vars
						); 
						$tmpSupFormule=$paramsTemplate;
						$paramsExtract=[];
						foreach($SubCompName as $compkey){
							$tmpSupFormule=$paramsTemplate;

							foreach($vars as $var){
								foreach($var as $varp0){
								$varp=str_ireplace(array("}","{"),"",$varp0);
								$UID=$initialP."#$compkey:".$varp;
								echo "<pre style='color: red;font-size: large;'>$UID</pre><br>";

								$valExtract=$this->CompEval->lookForVariable($UID); 
								$tmpSupFormule=str_ireplace($varp0,$valExtract,$tmpSupFormule);

								$this->CompEval->_Trace[]=array(
									"Formule"=>$tmpSupFormule
									,"desc"=>"Valeur des variable $UID"
									,"Evaluation"=>$valExtract
								); 

								}
							}
							$paramsExtract[]=$tmpSupFormule;
						} 
						$this->CompEval->_Trace[]=array(
							"Formule"=>$formuleEvaluated
							,"desc"=>"Valeur des variable "
							,"Evaluation"=>$paramsExtract
						); 
						$strparams=implode(",",$paramsExtract);
						$formuleEvaluated=str_ireplace($matchesformule[0],$strparams,$formuleEvaluated);
					} 
				}		
			}
			echo "<pre>";print_r($this->CompEval->_Trace);echo "</pre>";
		 while (preg_match($this->_Model_Exp_Reg['variable'],$formuleEvaluated,$matches)){
             if(isset($matches[0]) && !empty($matches[0])){
                $UID=str_ireplace(array("}","{"),"",$matches[0]);
               // echo "$UID<br>";
			   
                $var=$this->CompEval->lookForVariable($UID);
				 echo "<pre class='bg-warning'>$UID:";print_r($var);echo "</pre>";

                if(is_array($var)){
                    $var = implode(",",$var);
                }
                 $formuleEvaluated=str_ireplace($matches[0],"$var",$formuleEvaluated);
             } 
         }
		 
		 $this->CompEval->_Trace[]=array(
			"Formule"=>$toEval
			,"Evaluation"=>$formuleEvaluated
			,"Resultat"=>$formuleEvaluated
		);
		 
		 return $formuleEvaluated;
	}

    public function detectFunction(RecordFormule $formule){

        //$_Has_Variable=preg_match($this->_Model_Exp_Reg['variable'],$formule->getToEval(),$matches);

        $formuleEvaluated=$formule->getToEval();
         echo "<pre style='color: darkgoldenrod;'>";print_r($formule);echo"</pre>";
		 
		 $matchExcept=preg_match($this->_Model_Exp_Reg['Methode'],$formuleEvaluated,$matchesformule);
		 $this->CompEval->_Trace[]=array(
			 "Formule"=>$formuleEvaluated
			 ,"desc"=>"Detection fonction "
			 ,"Evaluation"=>$matchesformule
		 ); 
			 
			 if($matchExcept){
				 $hasparams=preg_match($this->_Model_Exp_Reg['params'],$formuleEvaluated,$params);
				 $this->CompEval->_Trace[]=array(
					 "Formule"=>$formuleEvaluated
					 ,"desc"=>"Detection parametre "
					 ,"Evaluation"=>$params
				 ); 
 
				 if($hasparams){
					  
					 $PComp=$this->CompEval;
					 $SubCompName=[];
					 if(isset($PComp->_SubComp) && is_array($PComp->_SubComp) && count($PComp->_SubComp)>0){ 
						  $SubCompName=array_keys($PComp->_SubComp);
					 }	
					 $compInitial="(\{+[A-Za-z0-9\s:#]*)";
						 $variable="(\{[_A-Za-z0-9:@*#*]+\})";
					 $hasparamsInitial=preg_match($compInitial,$formuleEvaluated,$Initial);
					 $initialP=str_ireplace("{","",$Initial[0]);  
						 $this->CompEval->_Trace[]=array(
							 "Formule"=>$formuleEvaluated
							 ,"desc"=>"Detection initial path sub comp variable value "
							 ,"Evaluation"=>$Initial
						 ); 
						 
					 foreach($params as $v){
						 $paramsTemplate=$v;
						 preg_match_all($variable,$v,$vars);
						 //print_r($vars);
						 $this->CompEval->_Trace[]=array(
							 "Formule"=>$formuleEvaluated
							 ,"desc"=>"Detection variables "
							 ,"Evaluation"=>$vars
						 ); 
						 $tmpSupFormule=$paramsTemplate;
						 $paramsExtract=[];
						 foreach($SubCompName as $compkey){
							 $tmpSupFormule=$paramsTemplate;
 
							 foreach($vars as $var){
								 foreach($var as $varp0){
								 $varp=str_ireplace(array("}","{"),"",$varp0);
								 $UID=$initialP."#$compkey:".$varp;
								 echo "<pre style='color: red;font-size: large;'>$UID</pre><br>";
 
								 $valExtract=$this->CompEval->lookForVariable($UID); 
								 $tmpSupFormule=str_ireplace($varp0,$valExtract,$tmpSupFormule);
 
								 $this->CompEval->_Trace[]=array(
									 "Formule"=>$tmpSupFormule
									 ,"desc"=>"Valeur des variable $UID"
									 ,"Evaluation"=>$valExtract
								 ); 
 
								 }
							 }
							 $paramsExtract[]=$tmpSupFormule;
						 } 
						 $this->CompEval->_Trace[]=array(
							 "Formule"=>$formuleEvaluated
							 ,"desc"=>"Valeur des variable "
							 ,"Evaluation"=>$paramsExtract
						 ); 
						 $strparams=implode(",",$paramsExtract);
						 $formuleEvaluated=str_ireplace($matchesformule[0],$strparams,$formuleEvaluated);
					 } 
				 }		
			 }
			 echo "<pre>";print_r($this->CompEval->_Trace);echo "</pre>";
			
			//subcomp params formule
			while (preg_match($this->_Model_Exp_Reg['variable'],$formuleEvaluated,$matches)){
				 if(isset($matches[0]) && !empty($matches[0])){
					$UID=str_ireplace(array("}","{"),"",$matches[0]);
				   // echo "$UID<br>";
				   echo "<pre style='color: red;font-size: large;'>$UID</pre><br>";
					$var=$this->CompEval->lookForVariable($UID);
					if(is_array($var)){
						$var = implode(",",$var);
					}
					 $formuleEvaluated=str_ireplace($matches[0],"$var",$formuleEvaluated);
					 $this->CompEval->_Trace[]=array(
						"Formule"=>$formuleEvaluated
						,"desc"=>"variable a evaluer"
						,"Evaluation"=>$var
					); 
				 } 
				
			}
		 
			echo "<pre style='color: blue;font-size: large;'>$formuleEvaluated =>";	print_r($this->CompEval->_Trace);echo"</pre><br>";
        $res = $this->evalfunction($formuleEvaluated,$formule);
        //trace de programme
        $this->CompEval->_Trace[]=array(
            "Formule"=>$formuleEvaluated
            ,"Evaluation"=>$res
        ); 
		if($res != 'RAF'){
			$formuleBind=$formule->getBind();
			foreach($formuleBind as $key => $val){
				$UID=str_ireplace(array("}","{"),"",$val);
				$this->CompEval->setIn($UID,$res);

				//trace de programme
				$this->CompEval->_Trace[]=array(
					"SET"=>$UID
				   ,"Evaluation"=>$res
				);
			}
			echo "<pre style='color: green;font-size: large;'>$UID : $res</pre><br>";
		}else{
			
			 echo "<pre style='color: red;font-size: large;'>$res !='RAF' - $UID : $res</pre><br>";
		}

        return $res;
    }

    private function evalfunction($formuleEvaluated,RecordFormule $formule){
        $res = null;
        switch($formule->getType()){
            case 'arithmetique':
                $res=$this->evalArithmetiquefunction($formuleEvaluated, $formule);
            break;
            case 'logique':
                $res=$this->evalLogiqueFunction($formuleEvaluated, $formule);

            break;
            case 'mixed':
                $res=$this->evalMixFunction($formuleEvaluated, $formule);

            break;
			
			case "logiqueComplex":
				$res=$this->evalComplexResFunction($formuleEvaluated, $formule);
			break;
        }
        return $res;
    }
    private function loaderFunction(){

    }

  private function evalArithmetiquefunction($formuleEvaluated,RecordFormule $formule){
      $use = "use Limostr\EvalLib\\MethodEval;";
      $res=null;
	  //formule evaluation oussama
      echo "$formuleEvaluated ------------> <br>";
   	  echo "<pre><b style='color:#FFAAFF'>";print_r($formule);echo "</b></pre>";
      eval("$use;\$res=$formuleEvaluated;");
	  
      $this->CompEval->_Trace[]=array(
        "Formule"=>$formuleEvaluated
          ,"Evaluation"=>$res
      );
	  
	  //echo "<pre><b style='color:red'>";print_r($this->CompEval->_Trace );echo "</b></pre>";
	  
      return $res;
  }
  private function evalLogiqueFunction($formuleEvaluated,RecordFormule $formule){
      $res=null; 

		echo "<pre><b style='color:#12F0A5'>";print_r($formule);echo "</b></pre>";
		echo "$formuleEvaluated ------------> <br>";
		echo "<b Style='color:#00F2F6'>\$res= $formuleEvaluated;</b><br>";
	 eval("\$res=$formuleEvaluated;");

      if($res){
          $resultat = $formule->getScore();
          if(is_array($resultat)){
				$res=$resultat['true'];
          }else{
              $res=$resultat;
          } 
		
      }else{
          $resultat = $formule->getScore();
          if(is_array($resultat)){
			  if(!isset($resultat['false'])){
				$res="RAF";
			  }else{
				$res=$resultat['false'];  
			  }
              
          }else{
              $res=$resultat['default'];
          }
      }
      //trace de programme
      $this->CompEval->_Trace[]=array(
          "Formule"=>$formuleEvaluated
        ,"Evaluation"=>$res
      );
	  echo "<pre><b style='color:#12F0A5'>";
			print_r(array(
						 "Formule"=>$formuleEvaluated
						,"Evaluation"=>$res
					  )
					 );
		echo "</b></pre>"; 
      return $res;
  }
  private function evalMixFunction($formuleEvaluated,RecordFormule $formule){
      $use = "use Limostr\EvalLib\\MethodEval;";
      $res=null;

       echo "$formuleEvaluated ------------> <br>";
      eval("$use;\$res=$formuleEvaluated;");
      if($res){
          $resultat = $formule->getScore();
          if(is_array($resultat)){
             if(!isset($resultat['true'])){
				$res="RAF";
			  }else{
				$res=$resultat['true'];  
			  }
          }else{
              $res=$resultat;
          }
      }else{
          $resultat = $formule->getScore();
         if(is_array($resultat)){
             if(!isset($resultat['false'])){
				$res="RAF";
			  }else{
				$res=$resultat['false'];  
			  }
          }else{
              $res=$resultat;
          }
      }

      //trace de programme
      $this->CompEval->_Trace[]=array(
           "Formule"=>$formuleEvaluated
          ,"Evaluation"=>$formule
          ,"Resultat"=>$res
      );
      return $res;
  }
  ///resultat si vrai est une formule
   private function evalComplexResFunction($formuleEvaluated,RecordFormule $formule){
      $use = "use Limostr\EvalLib\\MethodEval;";
      $res=null;
	  $ResComplexFormule="";
	  $resultatChoix="";
        echo "<b style='color:blue'>Complex $use;<br>\$res=$formuleEvaluated; </b><br>";
	    echo "<pre style='color:#FF10FA'>";print_r($formule);echo "</pre>";
	   
      eval("$use;\$res=($formuleEvaluated);");
      if($res){
          $resultat = $formule->getScore();
          if(is_array($resultat)){
              $res=$resultat['true'];
			  if(isset($resultat['typeTrue']) && $resultat['typeTrue']=='arithmetique'){
				  echo "----------------->".$resultat['true'];
				$ResComplexFormule=$this->ComplexResultCondition($resultat['true']);
				echo $ResComplexFormule;
				eval("$use;\$resComplex=$ResComplexFormule;"); 
				$res=$resComplex; 
			  }else{
				$res=$resultat['true'];  
			  }
			   $resultatChoix=$resultat['true'];  
          }else{
              $res=$resultat;
          }
      }else{
          $resultat = $formule->getScore();
          if(is_array($resultat)){
			  if(isset($resultat['false']) && isset($resultat['typeFalse']) && $resultat['typeFalse']=='arithmetique'){
				$ResComplexFormule=$this->ComplexResultCondition($resultat['false']);
				echo "<b style='color:#FF10FA'>$use;\$resComplex=$ResComplexFormule;</b>";

				eval("$use;\$resComplex=$ResComplexFormule;"); 
				$res=$resComplex; 
				$resultatChoix=$resultat['false']; 
			  }elseif(isset($resultat['false'])){
				$res=$resultat['false'];  
				$resultatChoix=$resultat['false']; 
			  }elseif(!isset($resultat['false'])){
				   $res="RAF";
				   $resultatChoix="RAF"; 
			  }
			  
          }else{
              $res=$resultat['default'];
			  $resultatChoix=$resultat['default']; 
          }
      }

      //trace de programme
      $this->CompEval->_Trace[]=array(
           "Formule"=>$formuleEvaluated
          ,"Evaluation"=>$resultatChoix
		  ,"ResultatScore"=>$ResComplexFormule
          , "Resultat"=>$res
      );
	   //echo "<pre class='bg-red'>";print_r($this->CompEval->_Trace);echo "</pre>";
      return $res;
  }
  
  public function __trace(){
	  
	  echo "<pre style='color:red;'>";
	  print_r($this->CompEval->_Trace);
	  echo "</pre>";
  }


}