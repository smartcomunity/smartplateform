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
        public function FindSUS($id)
        {
            $results1=$this->adapter->query(
                'SELECT * FROM  unit  AS u 
                 LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                 where u.Session_id ="'.$id.'"',
                Adapter::QUERY_MODE_EXECUTE
            );
            $results1=$results1->toArray();
            $arr=[];
            $j=0;
            foreach ($results1 as $key => $row) {
                $arr[$j]["Session_id"]=$row ['idSession'];
                $arr[$j]["SessionType"]=$row ['SessionType'];
                $arr[$j]["SessionNumber"]=$row ['SessionNumber'];
                $arr[$j]["idunit"]=$row ['idunit'];
                $arr[$j]["unitLabel"]=$row ['unitLabel'];
                $arr[$j]["unitcredit"]=$row['unitcredit'];
                $arr[$j]["unitcoeficient"]=$row ['unitcoeficient'];
                $arr[$j]["unitNature"]=$row ['unitNature'];
                $arr[$j]["unitRegimen"]=$row ['unitRegimen'];
                $j++;
                $idunit=$row['idunit'];
                $results2=$this->adapter->query(
                    'SELECT * FROM  unit  AS u 
                     RIGHT JOIN subject AS su ON u.idunit =su.unit_id
                     where u.idunit ="'.$idunit.'"',
                    Adapter::QUERY_MODE_EXECUTE
                );
                $results2=$results2->toArray();
                foreach ($results2 as $key2 => $row2) {
                    $arr[$j]["subject"]=$results2;
                    $j++;
                }
            }
            return $arr;
        }
        public function fetchAll()
        {
            $arr=[];
            $arr2=[];
            $arr3=[];
            $results1=$this->adapter->query(
                'SELECT * FROM  degree  AS d
                 LEFT JOIN elementmetaprocess  AS e ON d.Model_id =e.id',
                Adapter::QUERY_MODE_EXECUTE
            );
            $results1=$results1->toArray();
            $i=0;
            $j=0;
            
            foreach ($results1 as $key => $row) {
                $Degree=$row['idDegree'];
                $rowset2= $this->TableGateway2->select(['Degree_id' => $Degree]);
                $results2 = $rowset2->toArray();
                $degree='';
                $k=0;
                $j=0;
                
                foreach ($results2 as $key2 => $row2) {
                    $idSession=$row2['idSession'];
                    // $arr2=$this->FindSUS($idSession);
                    $arr3[$j]=$this->FindSUS($idSession);
                    $j++;
                    /*$rowset3= $this->TableGateway3->select(['Session_id' => $idSession]);
                    $results3 = $rowset3->toArray();
                    $arr2[$k]=$results3;
                    $k++;*/
                    /*$res=$this->adapter->query(
                        'SELECT * FROM  unit  AS u
                         LEFT JOIN session  AS s ON u.Session_id =s.idSession
                         RIGHT JOIN subject AS su ON u.idunit =su.unit_id
                         where u.Session_id ="'.$idSession.'"',
                        Adapter::QUERY_MODE_EXECUTE
                    );

                    foreach ($res as $key3 => $row3) {
                        $arr2[$j]["Session_id"]=$row3 ['Session_id'];
                        $arr2[$j]["SessionType"]=$row3 ['SessionType'];
                        $arr2[$j]["SessionNumber"]=$row3 ['SessionNumber'];
                        $arr2[$j]["idunit"]=$row3 ['idunit'];
                        $arr2[$j]["unitLabel"]=$row3 ['unitLabel'];
                        $arr2[$j]["unitcredit"]=$row3 ['unitcredit'];
                        $arr2[$j]["unitcoeficient"]=$row3 ['unitcoeficient'];
                        $arr2[$j]["unitNature"]=$row3 ['unitNature'];
                        $arr2[$j]["unitRegimen"]=$row3 ['unitRegimen'];
                        $arr2[$j]["idsubject"]=$row3 ['idsubject'];
                        $arr2[$j]["subjectlabel"]=$row3 ['subjectlabel'];
                        $arr2[$j]["subjectCoefficient"]=$row3 ['subjectCoefficient'];
                        $arr2[$j]["subjectcredit"]=$row3 ['subjectcredit'];
                        $arr2[$j]["subjectRegimen"]=$row3 ['subjectRegimen'];
                        $arr2[$j]["hourlyVolume"]=$row3 ['hourlyVolume'];
                        $j++;
                        $arr3[$k]=$arr2;
                        $k++;
                    }

                    /*$res=$res->toArray();
                    $arr2[$k]=$res;
                    $k++;*/
                }
                /*foreach ($results3 as $key3=> $row3) {
                    $idunit=$row3['idunit'];
                    $rowset4= $this->TableGateway4->select(['unit_id' => $idunit]);
                    $results4 = $rowset4->toArray();
                }
                */
                
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
                //$arr[$i]["session"]=$results2;
                //$arr[$i]["unit"]=$arr2;
                $arr[$i]["S.U.S"]=$arr3;
                //$arr[$i]["unit"]=$results3;
                // $arr[$i]["subject"]=$results4;
                $i++;
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
