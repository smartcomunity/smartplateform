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
                    $j++;
                    $session=$row2 ['idSession'];
                    $rowset4= $this->TableGateway3->select(['Session_id' => $session]);
                    $results4 = $rowset4->toArray();
                    foreach ($results4 as $key4 => $row4) {
                        $arr4[$y]["Session_id"]=$row4 ['Session_id'];
                        $arr4[$y]["idunit"]=$row4['idunit'];
                        $y++;
                    }
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
                        unset($arr3[$c]);
                        $c=$c-1;
                    }
                }
            }
            
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
                    $x=$keys[$l];
                    $l++;
                    foreach ($results3 as $key3 => $row3) {
                        $arr3[$m]["idunit"]=$row3 ['idunit'];
                        $arr3[$m]["unitLabel"]=$row3 ['unitLabel'];
                        $arr3[$m]["unitcredit"]=$row3['unitcredit'];
                        $arr3[$m]["unitcoeficient"]=$row3 ['unitcoeficient'];
                        $arr3[$m]["unitNature"]=$row3 ['unitNature'];
                        $arr3[$m]["unitRegimen"]=$row3 ['unitRegimen'];
                        $m++;
                    }
                    
                    $arr[$x]["Unit"]=$arr3;
                    $c=(count($arr3));
                    while ($m<$c) {
                        unset($arr3[$c]);
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
