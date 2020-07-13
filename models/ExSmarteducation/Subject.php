<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

    class Subject
    {
        protected $adapter;
        protected $TableGateway;
        public function __construct(Adapter $adapter)
        {
            $this->adapter = $adapter;
            $this->TableGateway= new TableGateway('subject', $adapter);
        }
    
        public function fetchAll()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();

            return $results;
        }
        public function fetchByEveryThing($data)
        {   //unset($arr1[""]);
            $sql    = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('subject');
            $select->where([$data['name'] => $data['value']]);
            //$select->where([$data=> $data]);

            $selectString = $sql->buildSqlString($select);
            $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
            return $results = $results->current();
        }
        public function fetch($id)
        {
            $rowset  = $this->TableGateway->select(['idsubject' => $id]);
            return $Row   = $rowset->current();
        }
        public function Create($data)
        {
            $arr=[];
            $this->TableGateway->insert($data);
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $arr= array_column($results, 'idsubject');
           
            return max($arr);
        }
        public function Update($data, $id)
        {
            return $this->TableGateway->update($data, ['idsubject' => $id], null);
        }
        public function Delete($id)
        {
            return  $this->TableGateway->delete(['idsubject' => $id]);
        }
        public function FindLastElement()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $max=0;
            foreach ($results as $key => $row) {
                $id=$row['idsubject'];
                $n=intval($id);
                if ($max<$n) {
                    $max=$n;
                }
            }
            return $max;
        }
    }
