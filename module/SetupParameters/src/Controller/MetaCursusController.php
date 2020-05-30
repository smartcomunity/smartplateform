<?php
/**
 * Oussama
 *
 * @copyright (c) 2020 oussama limam
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace SetupParameters\Controller;
 
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;  
use Interop\Container\ContainerInterface;
  
/**
 * MetaCursus
 *
 * Handles the MetaCursusController requests for the Cursus Module
 *
 * @package MetaCursus\Controller
 */
class MetaCursusController extends AbstractActionController
{

     
     
    private $Container;
    private $adapter;
    public function __construct(ContainerInterface $Container)
    { 
        $this->Container = $Container;
        $this->adapter=$this->Container->get(\Laminas\Db\Adapter\AdapterInterface::class);
    }

    /**
     * Index action for MetaCursusController
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $viewModel = new ViewModel(); 
        $ContextListe= new \Models\ExSmarteducation\ExMetacontextTable($this->adapter);
       $all= $ContextListe->getContext();
       $viewModel->all=$all;
        return $viewModel;                                                                                       return $viewModel;
    }



     /**
     * Index action for MetaCursusController
     *
     * @return ViewModel
     */
    public function addCursusAction()
    {
        $viewModel = new ViewModel(); 
        $form = new \SetupParameters\Form\Cursusform();
        $viewModel->form=$form;
      //  $ContextListe= new \Models\Smarteducation\Model\MetacontextTable($this->adapter);
        return $viewModel;                                                                                       return $viewModel;
    }
    
}
