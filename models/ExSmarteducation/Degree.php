<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

    class Degree
    {
        protected $adapter;
        protected $TableGateway;
        public function __construct(Adapter $adapter)
        {
            $this->adapter = $adapter;
            $this->TableGateway= new TableGateway('degree', $adapter);
            $this->TableGateway2= new TableGateway('session', $adapter);
            $this->TableGateway3= new TableGateway('unit', $adapter);
            $this->TableGateway4= new TableGateway('subject', $adapter);
        }
        
        public function fetchAll()
        {
            $arr=[];
            $arr2=[];
            $arr3=[];
            $arr4=[];
            $results1=$this->adapter->query(
                'SELECT * FROM  degree  AS d
                 LEFT JOIN elementmetaprocess  AS e ON d.Model_id =e.id',
                Adapter::QUERY_MODE_EXECUTE
            );
            $results1=$results1->toArray();
            $i=0;
            $j=0;
            $k=0;
            $l=0;
            $m=0;
            $y=0;
            foreach ($results1 as $key => $row) {
                $Degree=$row['idDegree'];
                $rowset2= $this->TableGateway2->select(['Degree_id' => $Degree]);
                $results2 = $rowset2->toArray();
                foreach ($results2 as $key2 => $row2) {
                    $arr2[$j]["idSession"]=$row2 ['idSession'];
                    $arr2[$j]["Degree_id"]=$row2 ['Degree_id'];
                    $session=$row2 ['idSession'];
                    $rowset4= $this->TableGateway3->select(['Session_id' => $session]);
                    $results4 = $rowset4->toArray();
                    foreach ($results4 as $key4 => $row4) {
                        $keys = array_keys(array_column($arr2, 'idSession'), $row4 ['Session_id']);
                        $l=0;
                        $m=0;
                        while ($l<count($keys)) {
                            $x=$keys[$l];
                            $l++;
                            foreach ($results4 as $k4 => $r4) {
                                $arr3[$m]["idunit"]=$r4 ['idunit'];
                                $m++;
                            }
                            $arr2[$x]["idunit"]=$arr3;
                            $c=(count($arr3));
                            while ($m<=$c) {
                                $c=$c-1;
                                unset($arr3[$c]);
                            }
                        }
                    }
                    $j++;
                }

                
                $arr[$i]["idDegree"]=$row ['idDegree'];
                $arr[$i]["Model_id"]=$row ['Model_id'];
                $arr[$i]["degreeLabel"]=$row ['degreeLabel'];
                $arr[$i]["MetaModelsWorker_id"]=$row ['MetaModelsWorker_id'];
                $arr[$i]["MetaContext_id"]=$row ['MetaContext_id'];
                $arr[$i]["LabelMetaProcess"]=$row ['LabelMetaProcess'];
                $arr[$i]["DescMetaProcess"]=$row ['DescMetaProcess'];
                $arr[$i]["model_type"]=$row ['model_type'];
                $arr[$i]["Field"]=$row ['Field'];
                $arr[$i]["Mention"]=$row ['Mention'];
                $arr[$i]["Specialty"]=$row ['Specialty'];
                $arr[$i]["Nb_years"]=$row ['Nb_years'];
                $arr[$i]["Calendar_sys"]=$row ['Calendar_sys'];
                $arr[$i]["nb_units"]=$row ['nb_units'];
                $arr[$i]["credit"]=$row ['credit'];
               
                $i++;
            }
            //session part
            for ($k = 0; $k < count($arr2); $k++) {
                $results3=$this->adapter->query(
                    'SELECT * FROM  unit  AS u 
                     LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                     where u.Session_id ="'.$arr2[$k]['idSession'].'"',
                    Adapter::QUERY_MODE_EXECUTE
                );
                
                $results3=$results3->toArray();
                $keys = array_keys(array_column($arr, 'idDegree'), $arr2[$k]['Degree_id']);
                $l=0;
                $m=0;
                while ($l< count($keys)) {
                    foreach ($results3 as $key3 => $row3) {
                        $arr3[$m]["Session_id"]=$row3 ['Session_id'];
                        $arr3[$m]["SessionType"]=$row3 ['SessionType'];
                        $arr3[$m]["SessionNumber"]=$row3 ['SessionNumber'];
                        $m++;
                    }
                    $x=$keys[$l];
                    $l++;
                    $arr[$x]["session"]=$arr3;
                    $c=(count($arr3));
                    while ($m<$c) {
                        $c=$c-1;
                        unset($arr3[$c]);
                    }
                }
            }
            //unit part
            for ($k = 0; $k < count($arr2); $k++) {
                $results5=$this->adapter->query(
                    'SELECT * FROM  unit  AS u 
                     LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                     where u.Session_id ="'.$arr2[$k]['idSession'].'"',
                    Adapter::QUERY_MODE_EXECUTE
                );
                
                $results5=$results5->toArray();
                $keys = array_keys(array_column($arr, 'idDegree'), $arr2[$k]['Degree_id']);
                $l=0;
                $m=0;
                while ($l< count($keys)) {
                    $x=$keys[$l];
                    $l++;
                    foreach ($results5 as $key5 => $row5) {
                        $arr5[$m]["idunit"]=$row5 ['idunit'];
                        $arr5[$m]["unitLabel"]=$row5 ['unitLabel'];
                        $arr5[$m]["unitcredit"]=$row5['unitcredit'];
                        $arr5[$m]["unitcoeficient"]=$row5 ['unitcoeficient'];
                        $arr5[$m]["unitNature"]=$row5 ['unitNature'];
                        $arr5[$m]["unitRegimen"]=$row5 ['unitRegimen'];
                        $m++;
                    }
                    
                    $arr[$x]["Unit"]=$arr5;
                    $c=(count($arr5));
                    while ($m<$c) {
                        unset($arr5[$c]);
                        $c=$c-1;
                    }
                }
            }
            //subject part
            for ($k = 0; $k < count($arr2); $k++) {
                $ok=false;
                $arr7=[];
                
                $n=0;
                foreach ($arr2 as $key => $value) {
                    foreach ($value as $sub_key => $sub_val) {
                        if (is_array($sub_val)) {
                            foreach ($sub_val as $k1 => $v) {
                                $ke = array_keys(array_column($arr2, 'idunit'), $sub_val);
                                $a=0;
                                while ($a< count($ke)) {
                                    $x=$ke[$a];
                                    $a++;
                                    $arr7[$n]=$v;
                                    $arr7[$n]['index']=$x;
                                    $n++;
                                }
                                $ok=true;
                            }
                        }
                    }
                }
                $n=$n-1;
                
                for ($e=0;$e<=$n;$e++) {
                    $idunit=$arr7[$e]['idunit'];
                    $results6=$this->adapter->query(
                        'SELECT * FROM  subject  AS s
                       where s.unit_id ="'.$idunit.'"',
                        Adapter::QUERY_MODE_EXECUTE
                    );
                    $results6=$results6->toArray();
                    $index=$arr7[$e]['index'];
                    $l=0;
                    $m=0;
                    foreach ($results6 as $key6 => $row6) {
                        $arr6[$m]["idsubject"]=$row6 ['idsubject'];
                        $arr6[$m]["subjectlabel"]=$row6 ['subjectlabel'];
                        $arr6[$m]["subjectCoefficient"]=$row6 ['subjectCoefficient'];
                        $arr6[$m]["subjectcredit"]=$row6 ['subjectcredit'];
                        $arr6[$m]["subjectRegimen"]=$row6 ['subjectRegimen'];
                        $arr6[$m]["hourlyVolume"]=$row6 ['hourlyVolume'];
                        $arr6[$m]["unit_id"]=$row6 ['unit_id'];
                        $m++;
                    }

                    $arr[$index]["subject"]=$arr6;
                   
                    $c=(count($arr6));
                    while ($m<$c) {
                        unset($arr6[$c]);
                        $c=$c-1;
                    }
                }
            }
            return $arr;
        }

        public function fetch($id)
        {
            $arr=[];
            $results1=$this->adapter->query(
                'SELECT * FROM  degree  AS d 
                 LEFT JOIN elementmetaprocess  AS e ON d.Model_id =e.id 
                 RIGHT JOIN session AS s ON d.idDegree =s.Degree_id 
                 where d.idDegree ="'.$id.'"',
                Adapter::QUERY_MODE_EXECUTE
            );
            $results1=$results1->toArray();
            $i=0;
            foreach ($results1 as $key => $row) {
                $idSession=$row['idSession'];
                $results2=$this->adapter->query(
                    'SELECT * FROM  unit  AS u 
                 LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                 RIGHT JOIN subject AS su ON u.idunit =su.unit_id 
                 where u.Session_id ="'.$idSession.'"',
                    Adapter::QUERY_MODE_EXECUTE
                );
                $results2=$results2->toArray();
                $arr[$i]["idDegree"]=$row ['idDegree'];
                $arr[$i]["Model_id"]=$row ['Model_id'];
                $arr[$i]["degreeLabel"]=$row ['degreeLabel'];
                $arr[$i]["MetaModelsWorker_id"]=$row ['MetaModelsWorker_id'];
                $arr[$i]["MetaContext_id"]=$row ['MetaContext_id'];
                $arr[$i]["LabelMetaProcess"]=$row ['LabelMetaProcess'];
                $arr[$i]["DescMetaProcess"]=$row ['DescMetaProcess'];
                $arr[$i]["model_type"]=$row ['model_type'];
                $arr[$i]["Field"]=$row ['Field'];
                $arr[$i]["Mention"]=$row ['Mention'];
                $arr[$i]["Specialty"]=$row ['Specialty'];
                $arr[$i]["Nb_years"]=$row ['Nb_years'];
                $arr[$i]["Calendar_sys"]=$row ['Calendar_sys'];
                $arr[$i]["nb_units"]=$row ['nb_units'];
                $arr[$i]["credit"]=$row ['credit'];
                $arr[$i]["S.U.S"]=$results2;
                $i++;
            }
            return $arr;
        }
        public function fetchByEveryThing($data)
        {
            $sql    = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('degree');
            $select->where([$data['name'] => $data['value']]);


            $selectString = $sql->buildSqlString($select);
            $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
            return $results = $results->current();
        }
        
        public function Create($data)
        {
            return $this->TableGateway->insert($data);
        }
        public function Update($data, $id)
        {
            return $this->TableGateway->update($data, ['idDegree' => $id], null);
        }
        public function Delete($id)
        {
            return  $this->TableGateway->delete(['idDegree' => $id]);
        }
        public function FindLastElement()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $max=0;
            foreach ($results as $key => $row) {
                $id=$row['idDegree'];
                $n=intval($id);
                if ($max<$n) {
                    $max=$n;
                }
            }
            return $max;
        }
    }
