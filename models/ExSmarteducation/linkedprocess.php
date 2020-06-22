<?php
 
namespace Models\ExSmarteducation;

    use Laminas\Db\TableGateway\TableGateway;
    use Laminas\Db\Adapter\Adapter;
    use Laminas\Db\Sql\Sql;

class linkedprocess
{   protected $adapter;
    protected $TableGateway;
    public function __construct(Adapter $adapter)
    {        $this->adapter = $adapter;
             $this->TableGateway= new TableGateway('linkedprocess',$adapter);

    }
    
    public function fetchAll()
    {
$rowset = $this->TableGateway->select();
$results = $rowset->toArray();

return $results;
    }
    public function fetch2($data)
    {   //unset($arr1[""]);
        $sql    = new Sql($this->adapter);
$select = $sql->select();
$select->from('linkedprocess');
$select->where([$data['name'] => $data['value']]);
//$select->where([$data=> $data]);

$selectString = $sql->buildSqlString($select);
$results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
        return $results = $results->current();
    }
    public function fetch($id)
    {    
        $rowset  = $this->TableGateway->select(['id' => $id]);
        return $Row   = $rowset->current();
    }
    public function Create($data)
    { 
        
        return $this->TableGateway->insert($data);
        /*$data['operation']='Created';
        return $data;*/
    }
    public function Update($data,$id)
    {   
        
        return $this->TableGateway->update($data,['id' => $id],null);
    }
    public function Delete($id)
    {
      
          return  $this->TableGateway->delete(
                ['id' => $id]);
           
    }


}
