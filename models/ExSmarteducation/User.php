<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

    class User
    {
        protected $adapter;
        protected $TableGateway;
        public function __construct(Adapter $adapter)
        {
            $this->adapter = $adapter;
            $this->TableGateway= new TableGateway('oauth_users', $adapter);
        }
    
        public function fetchAll()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            return $results;
        }
        public function fetchForAnything($data)
        {
            $sql    = new Sql($this->adapter);
            $select = $sql->select();
            $select->from('metacontext');
            $select->where([$data['name'] => $data['value']]);

            $selectString = $sql->buildSqlString($select);
            $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
            return $results = $results->current();
        }
        public function UserType($id)
        {
            $arr=[];
            $rowset  = $this->TableGateway->select(['username' => $id]);
            $results = $rowset->toArray();
            foreach ($results as $key => $row) {
                $arr[0]["userType"]=$row['userType'];
            }
            return $arr;
        }
        public function fetch($id)
        {
            $rowset  = $this->TableGateway->select(['username' => $id]);
            return $Row   = $rowset->current();
        }
        public function Create($data)
        {
            return $this->TableGateway->insert($data);
        }
        public function Update($data, $id)
        {
            return $this->TableGateway->update($data, ['username ' => $id], null);
        }
        public function Delete($id)
        {
            return  $this->TableGateway->delete(['username' => $id]);
        }
        public function FindLastElement()
        {
            $rowset = $this->TableGateway->select();
            $results = $rowset->toArray();
            $max=0;
            foreach ($results as $key => $row) {
                $id=$row['id'];
                $n=intval($id);
                if ($max<$n) {
                    $max=$n;
                }
            }
            return $max;
        }
        public function RevokeToken($token)
        {
            $results=$this->adapter->query(
                'DELETE FROM oauth_access_tokens WHERE access_token="'.$token.'"',
                Adapter::QUERY_MODE_EXECUTE
            );
            return $results;
        }
    }
