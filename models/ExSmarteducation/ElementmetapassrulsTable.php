<?php
 
namespace Models\ExSmarteducation;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;

class ElementmetapassrulsTable
{
    protected $adapter;
    protected $TableGateway;
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->TableGateway= new TableGateway('elementmetapassruls', $adapter);
    }
    
    public function fetchAll()
    {
        $rowset = $this->TableGateway->select();
        $results = $rowset->toArray();
        return $results;
    }
    public function fetch($id)
    {
        $rowset  = $this->TableGateway->select(['Pass_id' => $id]);
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
        return $this->TableGateway->update($data, ['Pass_id' => $id], null);
    }
    public function Delete($id)
    {
        return  $this->TableGateway->delete(['Pass_id' => $id]);
    }
    public function FindLastElement()
    {
        $rowset = $this->TableGateway->select();
        $results = $rowset->toArray();
        $max=0;
        foreach ($results as $key => $row) {
            $id=$row['Pass_id'];
            $n=intval($id);
            if ($max<$n) {
                $max=$n;
            }
        }
        return $max;
    }
}
