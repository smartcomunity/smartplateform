<?php
namespace SetupParameters\V1\Rest\SrvMetaCursus;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Interop\Container\ContainerInterface;
use Models\ExSmarteducation\Db;
use Laminas\Db\Adapter\AdapterInterface;

class SrvMetaCursusResource extends AbstractResourceListener
{   
    
    
    private $adaspter;
    public function __construct(AdapterInterface $adapter)
    { 
        $this->adapter = $adapter;
        
        
    }
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    { $ContextListe= new Db($this->adapter,'metacontext');
        $fetch=$ContextListe->fetch($data->id);
       /* $array = array(
            "id" => $data->id,
            "labelMetaContext" => $data->labelMetaContext,
            "DescMetaContext" => $data->DescMetaContext
          );*/
          $array=(array)$data;
        
          if (empty($fetch->id))
        {  return $ContextListe->Create($array);
          
        }
        else{
        return new ApiProblem(405, $data->id.' already taken');}
    
        
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {  $ContextListe= new Db($this->adapter,'metacontext');
        $fetch=$ContextListe->fetch($id);
        if (empty($fetch->id))
      {
        return new ApiProblem(405, $id.' dont exist');
      }
      else{
        return $ContextListe->Delete($id);
      }
        //return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $ContextListe= new Db($this->adapter,'metacontext');
        return $ContextListe->fetch($id);

    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $ContextListe= new Db($this->adapter,'metacontext');
        return $ContextListe->fetchAll();
    }
    

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id,$data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {    $ContextListe= new Db($this->adapter,'metacontext');
        $fetch=$ContextListe->fetch($id);
         /* $array = array(
        "id" => $data->id,
        "labelMetaContext" => $data->labelMetaContext,
        "DescMetaContext" => $data->DescMetaContext
      );*/
      $array=(array)$data;
      if (empty($fetch->id))
      {
        return new ApiProblem(405, $id.' dont exist');
      }
      else{
        
        return $ContextListe->Update($array,$id);
    }
        //return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
