<?php

class Application_Model_Question_AdapterFactory
{
    protected $_em;
    
    /**
     * @param string $type
     * @return Application_Model_Question_Adapter_Abstract
     */
    public function getAdapter($type) {
        $adapterClass = 'Application_Model_Question_Adapter_'.ucfirst($type);
        return new $adapterClass($this->getEntityManager());
    }
    
    public function getEntityManager() {
        return $this->_em;
    }
    
    public function setEntityManager($entityManager) {
        $this->_em = $entityManager;
    }
    
}

