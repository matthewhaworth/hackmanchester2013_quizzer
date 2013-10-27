<?php
class Application_Model_Question_Adapter_Abstract
{
    protected $_em;
    
    public function __construct($entityManager) {
        if(is_null($entityManager)) {
            throw new Exception('No entity manager set.');
        }
        
        $this->_em = $entityManager;
    }
    
    protected function getEntityManager()
    {
        return $this->_em;
    }

}

