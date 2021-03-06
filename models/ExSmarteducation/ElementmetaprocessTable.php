<?php
namespace Models\ExSmarteducation;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Sql\Sql;

class ElementmetaprocessTable
{
    protected $arr=[];
    protected $adapter;
    protected $TableGateway;
    protected $TableGateway2;
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
            
        $this->TableGateway= new TableGateway('elementmetaprocess', $adapter);
        $this->TableGateway2= new TableGateway('linkedprocess', $adapter);
        $this->TableGateway3= new TableGateway('elementmetapassruls', $adapter);
        $this->TableGateway4= new TableGateway('metacontext', $adapter);
        $this->TableGateway5= new TableGateway('metamodelsworker', $adapter);
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
            'SELECT * FROM  elementmetaprocess  AS e 
        LEFT JOIN linkedprocess AS l ON e.id=l.MetaProcess 
        LEFT JOIN elementmetapassruls  AS p ON e.id=p.ElementMetaProcess_id  
        WHERE e.id ="'.$id.'"',
            Adapter::QUERY_MODE_EXECUTE
        );
        $arr=[];
        $res=$results->toArray();
        foreach ($res as $key => $row) {
            $arr[0]["MetaModelsWorker_id"]=$row ['MetaModelsWorker_id'];
            $arr[0]["MetaContext_id"]=$row ['MetaContext_id'];
            $arr[0]["l_id"]=$row ['l_id'];
            $arr[0]["Pass_id"]=$row ['Pass_id'];
        }
        return $arr;
        //return $results->toArray();
    }

    public function fetch($id)
    {
        $rowset  = $this->TableGateway->select(['id' => $id]);
        return $Row   = $rowset->current();
    }

    public function fetchV2($id)
    {
        $arr1=[];
        $arr=[];
        $arr1=$this->fetchwithlinked($id);
        $rowset  = $this->TableGateway->select(['id' => $id]);
        $results   = $rowset->toArray();

        $rowset2 = $this->TableGateway2->select(['MetaProcess' => $id]);
        $results2 = $rowset2->toArray();
    
        $rowset3 = $this->TableGateway3->select(['ElementMetaProcess_id' => $id]);
        $results3 = $rowset3->toArray();
    
        $rowset4 = $this->TableGateway4->select(['id' => $arr1[0]["MetaContext_id"]]);
        $results4 = $rowset4->toArray();
    
        $rowset5 = $this->TableGateway5->select(['id' => $arr1[0]["MetaModelsWorker_id"]]);
        $results5 = $rowset5->toArray();
        $i=0;
        foreach ($results as $key => $row) {
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

    public function Create($data)
    {
        return $this->TableGateway->insert($data);
        /*$data['operation']='Created';
        return $data;*/
    }
    public function Update($data, $id)
    {
        return $this->TableGateway->update($data, ['id' => $id], null);
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
            if ($max<$n) {
                $max=$n;
            }
        }
        return $max;
    }
    public function fetchByEveryThing($data)
    {
        $arr=[];
        $sql    = new Sql($this->adapter);
        $select = $sql->select();
        $select->from('elementmetaprocess');
        $select->where([$data['name'] => $data['value']]);
        $selectString = $sql->buildSqlString($select);
        $results = $this->adapter->query($selectString, $this->adapter::QUERY_MODE_EXECUTE);
        $i=0;
        foreach ($results as $key => $row) {
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
            $i++;
        }
        return $arr;
    }
    public function fetchByEveryThingV2($data)
    {
        $arr=[];
        $j=0;
        foreach ($data as $key => $row) {
            $j++;
        }
        switch ($j) {
    case 1:
        $rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess']]);
        break;
    case 2:
        $rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess'],
                                                 'model_type' => $data['model_type']]);
        break;
    case 3:
        $rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess'],
                                                    'model_type' => $data['model_type'],
                                                    'Field' => $data['Field']]);
        break;
    case 4:
        $rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess'],
                                                'model_type' => $data['model_type'],
                                                'Field' => $data['Field'],
                                                'Mention' => $data['Mention']]);
        break;
    case 5:
        $rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess'],
                                                'model_type' => $data['model_type'],
                                                'Field' => $data['Field'],
                                                'Mention' => $data['Mention'],
                                                'Specialty' => $data['Specialty']
            ]);
            break;
  }
        /*$rowset  = $this->TableGateway->select(['LabelMetaProcess' => $data['LabelMetaProcess'],
        'model_type' => $data['model_type'],
        'Field' => $data['Field'],
        'Mention' => $data['Mention'],
        'Specialty' => $data['Specialty'],
        ]);*/
    
        $i=0;
        foreach ($rowset as $key => $row) {
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
            $i++;
        }
        return $arr;
    }
    public function fetchByEveryThingV3($data)
    {
        $arr=[];
        $j=0;
        foreach ($data as $key => $row) {
            $j++;
        }
        switch ($j) {
      case 2:
          $rowset  = $this->TableGateway->select([$data['n1'] => $data['v1']]);
          break;
      case 4:
          $rowset  = $this->TableGateway->select([ $data['n1'] => $data['v1'],
                                                   $data['n2'] => $data['v2']]);
          break;
      case 6:
          $rowset  = $this->TableGateway->select([$data['n1'] => $data['v1'],
                                                  $data['n2'] => $data['v2'],
                                                  $data['n3'] => $data['v3']]);
          break;
      case 8:
          $rowset  = $this->TableGateway->select([$data['n1'] => $data['v1'],
                                                  $data['n2'] => $data['v2'],
                                                  $data['n3'] => $data['v3'],
                                                  $data['n4'] => $data['v4']]);
          break;
      case 10:
          $rowset  = $this->TableGateway->select([$data['n1'] => $data['v1'],
                                                  $data['n2'] => $data['v2'],
                                                  $data['n3'] => $data['v3'],
                                                  $data['n4'] => $data['v4'],
                                                  $data['n5'] => $data['v5']
              ]);
              break;
    }
    
        $i=0;
        foreach ($rowset as $key => $row) {
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
            $i++;
        }
        return $arr;
    }
}
