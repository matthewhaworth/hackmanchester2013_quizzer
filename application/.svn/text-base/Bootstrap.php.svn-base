<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctrine2()
    {
        if ($entityManager = $this->getPluginResource('doctrine2')->init()) {
            Zend_Registry::set('doctrine_em', $entityManager);
        }
        
    }
    
    protected function _initConfig() 
    {
        Zend_Registry::set('config', new Zend_Config($this->getOptions()));
    }
    
   protected function _initLog()
    {
        $logDirPath = APPLICATION_PATH . '/../log';
        
        if (!is_dir($logDirPath)) {
            if(!mkdir($logDirPath)) {
                throw new Exception('Could not create log folder.');
            }
        }
        
        $writer = new Zend_Log_Writer_Stream($logDirPath . '/system.log' ,'a');        
        $logger = new Zend_Log($writer);
        Zend_Registry::set('logger', $logger);
        
        $writer = new Zend_Log_Writer_Stream($logDirPath . '/memoryusage.log' ,'a');        
        $memoryLogger = new Zend_Log($writer);
        Zend_Registry::set('memory-logger', $memoryLogger);
    }
}