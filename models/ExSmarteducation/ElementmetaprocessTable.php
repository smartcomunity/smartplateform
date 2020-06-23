<?php
namespace Models\ExSmarteducation;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;
class ElementmetaprocessTable 
{  protected $arr=[];
    protected $adapter;
    protected $TableGateway;
    protected $TableGateway2;
    public function __construct(Adapter $adapter)
    {        $this->adapter = $adapter;
            
             $this->TableGateway= new TableGateway('elementmetaprocess',$adapter);
             $this->TableGateway2= new TableGateway('linkedprocess',$adapter);

    }
    public function fetchAll2()
    {


        $rowset = $this->TableGateway->select();
        $results = $rowset->toArray();
        
foreach ($results as $key => $row) {
    $id=$row['id'];
    $rowset2 = $this->TableGateway2->select(['MetaProcess' => $id]);
    $results2 = $rowset2->toArray();
    $arr [] = array(
        'id'         => $row ['id'],
        'MetaModelsWorker_id'     => $row ['MetaModelsWorker_id'],
        'MetaContext_id' => $row ['MetaContext_id'],
        'LabelMetaProcess '=> $row ['LabelMetaProcess'],
        'DescMetaProcess' => $row ['DescMetaProcess'],
        'Sp '         => $results2
    );
    
    //$p=array_search($id,array_keys($results));
    
    //$row['sp']=$results2;
    //return $row['sp'];
    

}

return $arr;
}
    public function fetch2()
    {  //the new way 
        $arr1 [] = array();
        $arr2 [] = array();
        $rowset = $this->TableGateway->select();
        $results = $rowset->toArray();
        
foreach ($results as $key => $row) {
    $id=$row['id'];
    $rowset2 = $this->TableGateway2->select(['MetaProcess' => $id]);
    $res= $rowset2->toArray();
    if(empty($res))
    {$arr1 [] = array(
        'id'         => $row ['id'],
        'MetaModelsWorker_id'     => $row ['MetaModelsWorker_id'],
        'MetaContext_id' => $row ['MetaContext_id'],
        'LabelMetaProcess '=> $row ['LabelMetaProcess'],
        'DescMetaProcess' => $row ['DescMetaProcess'],
    );}
}
$sql    = new Sql($this->adapter);
        $select = $sql->select();
        $select
    ->from(['p' => 'elementmetaprocess'])     
    ->join(
        ['l' => 'linkedprocess'],        
        'p.id = l.MetaProcess '  
    );
    $selectString = $sql->buildSqlString($select);
    $results2 = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
    foreach ($results2 as $key => $row) {
        $arr2 [] = array(
            'id'         => $row ['id'],
            'MetaModelsWorker_id'     => $row ['MetaModelsWorker_id'],
            'MetaContext_id' => $row ['MetaContext_id'],
            'LabelMetaProcess '=> $row ['LabelMetaProcess'],
            'DescMetaProcess' => $row ['DescMetaProcess'],
            'id' => $row ['id'],
            'Linked' => $row ['Linked'],
        );
    }
       $arr=array_merge($arr2, $arr1);
       return $arr;
    }

    public function fetchAll()
    {
$rowset = $this->TableGateway->select();
$results = $rowset->toArray();
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
      
          return  $this->TableGateway->delete(
                ['id' => $id]);
           
    }



}
