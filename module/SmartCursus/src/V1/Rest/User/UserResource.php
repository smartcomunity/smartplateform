<?php
namespace SmartCursus\V1\Rest\User;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Models\ExSmarteducation\User;
use Laminas\Db\Adapter\AdapterInterface;

class UserResource extends AbstractResourceListener
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
        $List= new User($this->adapter);
        $options = [
        'cost' => 10,
    ];
        $pass=password_hash($data->password, PASSWORD_BCRYPT, $options);
        $fetch=$List->fetch($data->username);
        $data->password=$pass;
        $array=(array)$data;
        if (empty($fetch)) {
            return $List->Create($array);
        } else {
            return new ApiProblem(405, $data->username.' already taken');
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $List= new User($this->adapter);
        $fetch=$List->fetch($id);
        if (empty($fetch)) {
            return new ApiProblem(405, $id.' Not Found');
        } else {
            $List->Delete($id);
            return true;
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
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $List= new User($this->adapter);
        return $List->fetch($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $List= new User($this->adapter);
        return $List->fetchAll();
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
        $List= new User($this->adapter);
        $fetch=$List->fetch($id);
                
        if (empty($fetch)) {
            return new ApiProblem(405, $id.' dont exist');
        } else {
            if (empty($data->password)) {
                $array=(array)$data;
                return $List->Update($array, $id);
            } else {
                $options = [
                    'cost' => 10,
                ];
                $pass=password_hash($data->password, PASSWORD_BCRYPT, $options);
                $data->password=$pass;
                $array=(array)$data;
                return $List->Update($array, $id);
            }
        }
    }
}
