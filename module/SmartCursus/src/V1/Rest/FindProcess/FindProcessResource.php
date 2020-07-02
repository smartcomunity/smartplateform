<?php
namespace SmartCursus\V1\Rest\FindProcess;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Models\ExSmarteducation\ElementmetaprocessTable;
use Laminas\Db\Adapter\AdapterInterface;
class FindProcessResource extends AbstractResourceListener
{   
    private $adapter;
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
    {
         $data=(array)$data;
         $List= new ElementmetaprocessTable($this->adapter);
         return $List->fetchByEveryThingV2($data);
        //return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {  $id=str_replace("."," ",$id);
        $pieces = explode("&", $id);
      /*$arr["name"]=$pieces[0];
       $arr["value"]=$pieces[1];*/
       $arr=[];
       $i=0;
       /*$j=1;
       $name="name";
       $value="value";
       $c=1;*/
       foreach ($pieces as $key => $row) {
        /*$str1=strval($c);
        $str2=strval($c+1);*/
        /*$name=$str1;
        $value=$str2;*/
        $arr[$i]=$pieces[$key];
        $i++;
        /*$x=$key+1;
        $arr[$str2]=$pieces[$x];
        $j=$j+2;
        $i=$i+2;
        $c++;*/
       }

        $List= new ElementmetaprocessTable($this->adapter);
        //return $List->fetchByEveryThing($arr);
        return $List->fetchByEveryThing2($arr);

    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
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
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
