<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

    class Session
    {
        protected $adapter;
        protected $TableGateway;
        public function __construct(Adapter $adapter)
        {
            $this->adapter = $adapter;
            $this->TableGateway= new TableGateway('session', $adapter);
        }
    
        public function fetchAll()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            return $results;
        }
        public function fetchByEveryThing($data)
        {
            $sql    = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('session');
            $select->where([$data['name'] => $data['value']]);


            $selectString = $sql->buildSqlString($select);
            $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
            return $results = $results->current();
        }
        public function fetch($id)
        {
            $rowset  = $this->TableGateway->select(['idSession' => $id]);
            return $Row   = $rowset->current();
        }
        public function Create($data)
        {
            $arr=[];
            $this->TableGateway->insert($data);
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $arr= array_column($results, 'idSession');
           
            return max($arr);
        }
        public function Update($data, $id)
        {
            return $this->TableGateway->update($data, ['idSession' => $id], null);
        }
        public function Delete($id)
        {
            return  $this->TableGateway->delete(['idSession' => $id]);
        }
        public function FindLastElement()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $max=0;
            foreach ($results as $key => $row) {
                $id=$row['idSession'];
                $n=intval($id);
                if ($max<$n) {
                    $max=$n;
                }
            }
            return $max;
        }
    }
