<?php
require 'Doctrine/ORM/Tools/Setup.php';

class Zedo_Resource_Doctrine2 extends Zend_Application_Resource_ResourceAbstract
{
    public function init() { 
        $setup = new Doctrine\ORM\Tools\Setup();
        $setup->registerAutoloadDirectory(APPLICATION_PATH . '/../library');
        
        $isDevMode = APPLICATION_ENV == 'production' ? false : true;
        $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            array($this->_getDoctrineConfig('modelsPath')),
            $isDevMode
        );
        
        $conn = array(
            'driver' => $this->_getDoctrineConfig('adapter'),
            'host' => $this->_getDoctrineConfig('host'),
            'dbname' => $this->_getDoctrineConfig('dbname'),
            'user' => $this->_getDoctrineConfig('username'),
            'password' => $this->_getDoctrineConfig('password'),
        );
          
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);        
        
        return $entityManager;
    }
    
    protected function _getDoctrineConfig($key) {
        $doctrineConfig = $this->getOptions();
        return $doctrineConfig[$key];
    }
}