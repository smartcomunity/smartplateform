<?php
 
namespace Models\ExSmarteducation;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;


class ElementmetapassrulsTable 
{
    protected $adapter;
    protected $TableGateway;
    public function __construct(Adapter $adapter)
    {        $this->adapter = $adapter;
             
             $this->TableGateway= new TableGateway('elementmetapassruls',$adapter);

    }
    
    public function fetchAll()
    {
$rowset = $this->TableGateway->select();
$results = $rowset->toArray();
/*foreach ($results as $key => $row) {
    $arr [] = array(
        'id'         => $row ['id'],
        'PassRulsDesc '     => $row ['PassRulsDesc '],
        'ElementMetaProcess_id  ' => $row ['ElementMetaProcess_id  '],
        'ElementMetaProcess_id1'         => $row ['ElementMetaProcess_id1'],
        'evenPassRuls '         => $row ['evenPassRuls '],
        'PassRuls '         => $row ['PassRuls '],
        'LabelPassRuls '         => $row ['LabelPassRuls '],
        'PassRulsOrder'         => $row ['PassRulsOrder']
    );

}
return $arr;*/
return $results;
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
      
          return  $this->TableGateway->delete(['id' => $id]);
           
    }
    public function FindLastElement()
    {
     $rowset = $this->TableGateway->select();
     $results = $rowset->toArray();
     $max=0;
     foreach ($results as $key => $row) {
       $id=$row['id'];
       $n=intval($id);
       if($max<$n)
       {$max=$n;}
     }
     return $max;
    }




}
