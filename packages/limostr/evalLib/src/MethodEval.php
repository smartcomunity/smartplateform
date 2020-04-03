<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 10/05/2018
 * Time: 13:47
 */

namespace Limostr\EvalLib;


Abstract class MethodEval
{

    public static function ExPro($iduser){


        $sqlString="
          SELECT * FROM cvparcourspro 
          INNER JOIN candidatcv ON cvparcourspro.idcandidatcv = candidatcv.idcandidatcv
        WHERE candidatcv.idcandidat = $iduser
";
         $experience= \library\database\dbadapter::SelectSQL($sqlString);
            $res=0;


            foreach ($experience as $val){

                 $nbranne=0;

                if(!empty($val['datedesuspension']) && trim($val['datedesuspension'])!="-"){
                    $datedebut = explode("-",$val['daterecrutement']);
                    $datedefin = explode("-",$val['datedesuspension']);

                    $nbranne=$datedefin[0]-$datedebut[0];
                }else{
                    $datedebut = explode("-",$val['daterecrutement']);
                    $nbranne=date("Y")-$datedebut[0];

                }
                $nbranne= ($nbranne==0) ? 1   : $nbranne;

                $res+=$nbranne;


            }
            return $res;

    }

    public static function SUM(){
        $parameters = func_get_args();
        $number_of_arguments = func_num_args();

        if($number_of_arguments>=1){
            $res=0;
            foreach ($parameters as $val){
                $res+=$val;
            }
            return $res;
        }else{
            return 0;
        }
    }

    /*public static function MAX(){
        $parameters = func_get_args();
        $number_of_arguments = func_num_args();
		return max($parameters);

    }*/
	public static function COUNTNOTZERO(){
		$parameters = func_get_args();
        $number_of_arguments = func_num_args();
		$res=0;
        if($number_of_arguments>=1){
			foreach ($parameters as $val){
				if($val>0){
						$res++;
				}
                
            }
		}
		return $res;
	}
    public static function MOYART(){
        $parameters = func_get_args();
        $number_of_arguments = func_num_args();
        if($number_of_arguments>=1){
            $res=0;
            foreach ($parameters as $val){
                $res+=$val;
            }
            if($number_of_arguments>0){
                return $res/$number_of_arguments;
            }
            return 0;

        }else{
            return 0;
        }
    }

}