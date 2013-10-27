<?php

class MessageController extends Quizzer_Controller_Abstract
{
    /**
     * @author Matthew Haworth
     */
    public function logRequest()
    {
        $requestData = var_export($this->getRequest()->getParams(), true);
        $this->_getLogger()->log($requestData, 0);
    }
    
    /**
     * @author Matthew Haworth
     * @author Chris Atty
     */
    public function receiveAction() 
    {
        $this->logRequest();
        if ($this->getRequest()->getParam('from')) {
            $data = $this->getRequest()->getParams();
                        
            $userRepository = $this->_getEntityManager()
                ->getRepository('Application_Model_Entities_User');
            /* @var $userRepository Application_Model_Repositories_UserRepository */
            $user = $userRepository->findUserByPhone($data['from']);
            /* @var $user Application_Model_Entities_User */
            
            if ($user && $user->getId()) {
               $queueItem = new Application_Model_Entities_Answer_Queue_Item;
               $queueItem->setMessage($data['content']);
               $queueItem->setQuestion($user->getLeague()->getCurrentRound()->getCurrentQuestion());
               $queueItem->setUser($user);
               $this->_getEntityManager()->persist($queueItem);
               $this->_getEntityManager()->flush();
            }
            
            $this->getResponse()->setHttpResponseCode(200);

        } else {
           $this->getResponse()->setHttpResponseCode(400);
        }
        $this->_helper->viewRenderer->setNoRender(true);
    }
}

