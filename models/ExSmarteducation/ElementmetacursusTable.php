<?php

namespace Models\ExSmarteducation;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;

class ElementmetacursusTable
{
    protected $adapter;
    protected $TableGateway;
    public function __construct(Adapter $adapter)
    {        $this->adapter = $adapter;
             $this->tabel=$tabel;
             $this->TableGateway= new TableGateway('elementmetacursus',$adapter);

    }
    
    public function fetchAll()
    {
$rowset = $this->TableGateway->select();
$results = $rowset->toArray();
foreach ($results as $key => $row) {
    $arr [] = array(
        'id'         => $row ['id'],
        'ElementMetaProcess_id'     => $row ['ElementMetaProcess_id'],
        'formations_id ' => $row ['formations_id ']
    );

}
return $arr;
    }
    public function fetch($id)
    {    
        $rowset  = $this->TableGateway->select(['id' => $id]);
        return $Row   = $rowset->current();
    }
    public function Create($data)
    {    return $this->TableGateway->insert($data);
        /*$data['operation']='Created';
        return $data;*/
    }
    public function Update($data,$id)
    {    return $this->TableGateway->update($data,['id' => $id],null);
    }
    public function Delete($id)
    {
      
          return  $this->TableGateway->delete(
                ['id' => $id]);
           
    }



}
