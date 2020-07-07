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
            $this->TableGateway2= new TableGateway('elementmetaprocess', $adapter);
        }
    
        public function fetchAll()
        {
            $arr=[];
            $results1=$this->adapter->query(
                'SELECT * FROM  degree  AS d 
                 LEFT JOIN elementmetaprocess  AS e ON d.Model_id =e.id 
                 RIGHT JOIN session AS s ON d.idDegree =s.Degree_id ',
                Adapter::QUERY_MODE_EXECUTE
            );
            $results1=$results1->toArray();
            $i=0;
            foreach ($results1 as $key => $row) {
                $id=$row['idSession'];
                $results2=$this->adapter->query(
                    'SELECT * FROM  unit  AS u 
                 LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                 RIGHT JOIN subject AS su ON u.idunit =su.unit_id 
                 where u.Session_id ="'.$id.'"',
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
