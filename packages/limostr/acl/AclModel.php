<?php

namespace Myhelper\Acl;

use Laminas\Permissions\Acl\Acl ;
use Laminas\Permissions\Acl\Role\GenericRole as Role;
use Laminas\Permissions\Acl\Resource\GenericResource as Resource;
use Laminas\session\container;
use Laminas\ServiceManager\ServiceManager;



class AclModel extends Acl
{
    //constructeur
    private $DBAdapter;

    private $serviceLocator;



    public function __construct($DBAdapter)
    {
        try{
            $this->DBAdapter=$DBAdapter;


        }catch(\Exception $e){
            echo $e->getMessage();
        }


    }

    public function initAcl()
    {

        try{


            $this->_initRessources();
            $this->_initRoles();
            $this->_initRights();
            $session = new Container('user');
            //$session->offsetSet("Acl",$this);
            
        }catch(\Exception $e){
            echo $e->getMessage();
        }



    }



    protected function _initRessources()
    {

        $services = new \Models\ExTutorat\ExServicesTable($this->DBAdapter);

        $service_rows=$services->select("idtypeservices= 'controller'");
        $this->addResource(new Resource("Application\\Authentification"));




        $this->addResource(new Resource('error'));
        //print_r($service_rows->toArray());
        foreach ($service_rows as $service){

            $this->addResource(new Resource($service['label']));
        }

    }


    protected function _initRoles()
    {

        //require_once  APPLICATION_PATH. '/models/DbTable/Rolereponsable.php';
        $roles = new \Models\Tutorat\Model\RolesTable($this->DBAdapter);
        $roles_rows=$roles->select();

        $roles_obj = new Role("guest");
        $this->addRole($roles_obj);
        foreach ($roles_rows as $role){
            $roles_obj = new Role($role->idroles);
            $this->addRole($roles_obj);
        }
    }

    protected function _initRights()
    {

        $services = new \Models\ExTutorat\ExServicesTable($this->DBAdapter);
        $roles = new \Models\Tutorat\Model\RolesTable($this->DBAdapter);

        $roles_rows=$roles->select();
        $this->allow("guest","Application\\Authentification",array("login","logout","permission-denied"));
        $this->allow("guest","Enseignant\\MonCompte",
            array(  "index"
                    ,"create-compte"
                    ,"demande-change-password"
                    ,"save-compte"
                    ,"change-password"
                ));



        if($roles_rows){

            $roles_rows=$roles_rows->toArray();

            foreach ($roles_rows as $role){
                $this->allow($role['idroles'],"Application\\Authentification",array("login","logout","permission-denied"));
                $this->allow($role['idroles'],"error");


            }

            foreach ($roles_rows as $role){
                $service_rows=$services->getAllServiceRole($role['idroles'],'Controller');

                foreach ($service_rows as $service){

                    $action_rows=$services->getAllServiceRole($role['idroles'],'Action',$service['codeservices']);

                    $action=array();
                    foreach ($action_rows as $action_row){
                        $action[]=$action_row['labelservice'];
                    }
                    if(!empty($action)){
                        $this->allow($role['idroles'],$service['labelservice']);
                    }else{
                        $this->allow($role['idroles'],$service['labelservice'],$action);
                    }
                }

            }

        }


    }

    public function isAccessAllowed($role, $resource, $permission)
    {

        if (! $this->hasResource($resource)) {
          /*  echo "<pre>";print_r($this->getResources());
            print_r($this->getRoles());
            echo "</pre>";
            echo $resource."<br>";*/
            return false;
        }
        if ($this->isAllowed($role, $resource, $permission)) {

            return true;
        }
        return false;
    }
}