<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

    class Unit
    {
        protected $adapter;
        protected $TableGateway;
        public function __construct(Adapter $adapter)
        {
            $this->adapter = $adapter;
            $this->TableGateway= new TableGateway('unit', $adapter);
        }
    
        public function fetchAll()
        {
            $results=$this->adapter->query(
                'SELECT * FROM  unit  AS u 
                 LEFT JOIN session  AS s ON u.Session_id =s.idSession 
                 RIGHT JOIN subject AS su ON u.idunit =su.unit_id ',
                Adapter::QUERY_MODE_EXECUTE
            );
        
            return $results;
        }
        public function fetchByEveryThing($data)
        {
            $sql    = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('unit');
            $select->where([$data['name'] => $data['value']]);


            $selectString = $sql->buildSqlString($select);
            $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
            return $results = $results->current();
        }
        public function fetch($id)
        {
            $rowset  = $this->TableGateway->select(['idunit' => $id]);
            return $Row   = $rowset->current();
        }
        public function Create($data)
        {
            return $this->TableGateway->insert($data);
            /*$data['operation']='Created';
            return $data;*/
        }
        public function Update($data, $id)
        {
            return $this->TableGateway->update($data, ['idunit' => $id], null);
        }
        public function Delete($id)
        {
            return  $this->TableGateway->delete(['idunit' => $id]);
        }
        public function FindLastElement()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $max=0;
            foreach ($results as $key => $row) {
                $id=$row['idunit'];
                $n=intval($id);
                if ($max<$n) {
                    $max=$n;
                }
            }
            return $max;
        }
    }
