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
        //$arr[] = array();
        $i=0;
foreach ($results as $key => $row) {
    $id=$row['id'];
    $rowset2 = $this->TableGateway2->select(['MetaProcess' => $id]);
    $results2 = $rowset2->toArray();
    $arr[$i]["id"]=$row ['id'];
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
    $arr[$i]["Lp"]=$results2;
    $i++;
    
}
//$arr=array_merge($results, $results2);
return $arr;
}
    public function fetch2()
    {  
    $results=$this->adapter->query(
        'SELECT * FROM linkedprocess AS l RIGHT JOIN elementmetaprocess AS e ON l.MetaProcess=e.id',
        Adapter::QUERY_MODE_EXECUTE
    );
       return $results;
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
    $array[0]["max"]=$max;
    return $array;
   }

}
