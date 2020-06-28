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
             $this->TableGateway3= new TableGateway('elementmetapassruls',$adapter);
             $this->TableGateway4= new TableGateway('metacontext',$adapter);
             $this->TableGateway5= new TableGateway('metamodelsworker',$adapter);

    }
    public function fetchAll2()
    {
        $rowset = $this->TableGateway->select();
        $results = $rowset->toArray();
        $i=0;
foreach ($results as $key => $row) {
    $id=$row['id'];
    $context=$row ['MetaContext_id'];
    $work=$row ['MetaModelsWorker_id'];

    $rowset2 = $this->TableGateway2->select(['MetaProcess' => $id]);
    $results2 = $rowset2->toArray();

    $rowset3 = $this->TableGateway3->select(['ElementMetaProcess_id' => $id]);
    $results3 = $rowset3->toArray();

    $rowset4 = $this->TableGateway4->select(['id' => $context]);
    $results4 = $rowset4->toArray();

    $rowset5 = $this->TableGateway5->select(['id' => $work]);
    $results5 = $rowset5->toArray();

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
    $arr[$i]["PassRules"]=$results3;
    $arr[$i]["MetaContext"]=$results4;
    $arr[$i]["Metamodelsworker"]=$results5;

    $i++;
    
}
return $arr;
}
    public function fetch2()
    {  
    $results=$this->adapter->query(
        'SELECT * FROM  elementmetaprocess  AS e 
        LEFT JOIN metacontext  AS m ON e.MetaContext_id=m.id
        LEFT JOIN metamodelsworker  AS w ON e.MetaModelsWorker_id=w.id
        INNER JOIN linkedprocess AS l ON e.id=l.MetaProcess 
        INNER JOIN elementmetapassruls  AS p ON e.id=p.ElementMetaProcess_id  ',
        Adapter::QUERY_MODE_EXECUTE
    );
   /* $results=$this->adapter->query(
        'SELECT * FROM  elementmetaprocess  AS e , linkedprocess AS l
        RIGHT JOIN elementmetapassruls  AS p ON e.id=p.ElementMetaProcess_id 
        RIGHT JOIN metacontext  AS m ON e.MetaContext_id=m.id
        RIGHT JOIN metamodelsworker  AS w ON e.MetaModelsWorker_id=w.id 
        WHERE  e.id=e.MetaContext_id=me.id ',
        Adapter::QUERY_MODE_EXECUTE
    );
    $i=0;
    $results=(array)$results;
    foreach ($results as $key => $row) {
        $id=$row["id"];
        $rowset = $this->TableGateway3->select(['ElementMetaProcess_id' => $id]);
        $results2 = $rowset->toArray();
        foreach ($results2 as $key2 => $row2){
            $results[$i]["Pass_id "]=$row2 ['Pass_id '];
            $results[$i]["PassRulsDesc"]=$row2 ['PassRulsDesc'];
            $results[$i]["ElementMetaProcess_id"]=$row2 ['ElementMetaProcess_id'];
            $results[$i]["evenPassRuls"]=$row2 ['evenPassRuls'];
            $results[$i]["PassRuls"]=$row2 ['PassRuls'];
            $results[$i]["LabelPassRuls"]=$row2 ['LabelPassRuls'];
            $results[$i]["PassRulsOrder"]=$row2 ['PassRulsOrder'];
            $i++;
            
        }

    }*/
       return $results;
    }

    public function fetchAll()
    {
  $rowset = $this->TableGateway->select();
  $results = $rowset->toArray();
return $results;
    }
    public function fetchwithlinked($id)
    {  
    $results=$this->adapter->query(
        'SELECT * FROM  elementmetaprocess  AS e LEFT JOIN linkedprocess AS l ON e.id=l.MetaProcess LEFT JOIN elementmetapassruls  AS p ON e.id=p.ElementMetaProcess_id  WHERE e.id ="'.$id.'"',
        Adapter::QUERY_MODE_EXECUTE
    );
       $arr=[];
       foreach ($results as $key => $row) {
        $arr[0]["MetaModelsWorker_id"]=$row ['MetaModelsWorker_id'];
        $arr[0]["MetaContext_id"]=$row ['MetaContext_id'];
        $arr[0]["l_id"]=$row ['l_id'];
        $arr[0]["PassRules_id"]=$row ['id'];
      }
      return $arr;
       //return $results;
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
      
          return  $this->TableGateway->delete( ['id' => $id]);
           
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
