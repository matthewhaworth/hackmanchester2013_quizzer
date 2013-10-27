<?php

class Quizzer_Controller_Abstract extends
Zend_Controller_Action {

    /**
     * @return Zend_Log
     */
    public function _getLogger() {
        return Zend_Registry::get('logger');
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function _getEntityManager() {
        return Zend_Registry::get('doctrine_em');
    }

    /**
     * @return Zend_Config
     */
    public function _getConfig() {
        return Zend_Registry::get('config');
    }

    protected function _requireLogin() {
        if (is_null($this->_getLoggedInUser())) {
            /*$this->_forward('error', 'error');*/
            $this->_redirect('/');
        }
    }

    protected function _getLoggedInUser() {
        $user = $this->_getEntityManager()
            ->find('Application_Model_Entities_User', $this->_getUserSession()->user_id);
        
        return $user;
    }
    
    protected function _logoutUser(){
        if (!is_null($this->_getLoggedInUser())) {
            $authNamespace = $this->_getUserSession();
            unset($authNamespace->user_id);
        }
    }

    protected function _getUserSession()
    {
        return new Zend_Session_Namespace('user');
    }
    public function preDispatch() {
        parent::preDispatch();
        $user = $this->_getLoggedInUser();
        if($user && $user->getId())
        {
            $this->view->loggedOn = true;
            $this->view->user = $user;
        }else{
            $this->view->loggedOn = false;
        }
    }
}