<?php
class CronController extends Quizzer_Controller_Abstract 
{
    public function preDispatch()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        return parent::preDispatch();
    }

    protected $_adapterTypes = array(
        'manual',
        'football',
        'biketime',
        'distance',
      	'radio',
      	'word',
    );
    
    protected $_questionAmount = 10;
    
    /**
     * @author Matthew Haworth
     */
    public function populateQuestionBufferAction() 
    {
        $adapterFactory = new Application_Model_Question_AdapterFactory;
        $adapterFactory->setEntityManager($this->_getEntityManager());
        
        $questions = array();
        foreach ($this->_adapterTypes as $_adapterType) {
            $adapter = $adapterFactory->getAdapter($_adapterType);
            /* @var $adapter Application_Model_Question_Adapter_Interface */
            for ($questionAmount = 0; $questionAmount < $this->_questionAmount; $questionAmount++) {
                if (!($question = $adapter->getQuestion()))  {
                    break;
                }
                
                $questions[] = $question;
            }
        }
        
        foreach ($questions as $_question) {
            $this->_getEntityManager()->persist($_question);
        }
        
        try {
            $this->_getEntityManager()->flush();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
        die('Cron success');
    }

    /**
     * @todo implement
     */
    public function sendQuestionsToUserAction() 
    {
        //get everything from round question table with scheduled time in past and sent time is null
        $now = new DateTime('now');
        $query = $this->_getEntityManager()->createQueryBuilder();
        $query->select('rq')
            ->from('Application_Model_Entities_Round_Question', 'rq')
            ->where('rq.sent_time IS NULL AND rq.scheduled_time < :current_time')
            ->setParameter('current_time', $now);
        
        $questions = $query->getQuery()->getResult();
        $apiKey = $this->_getConfig()->get('clockworksms')->get('apikey');
        $clockwork = new Clockwork_Clockwork($apiKey);
        foreach($questions as $_question) {
            /* @var $_question Application_Model_Entities_Round_Question */
            // Clean Queue
            $users = $_question->getRound()->getLeague()->getUsers();
            $queueItemsToDelete = $this->_getQueueItemsByUsers($users);
            foreach ($queueItemsToDelete as $_queueItemToDelete) {
                $this->_getEntityManager()->remove($_queueItemToDelete);
            }
            
            $_question->send($clockwork);
            $this->_getEntityManager()->persist($_question);
        }
        $this->_getEntityManager()->flush();
        die('cron ran');
    }

    protected function _getQueueItemsByUsers($users)
    {
        $userIds = array();
        foreach ($users as $_user) {
            $userIds[] = $_user->getId();
        }
        
        $query = $this->_getEntityManager()->createQueryBuilder()
            ->select('aqi')
            ->from('Application_Model_Entities_Answer_Queue_Item','aqi')                
            ->andWhere('aqi.user IN (:users)')
            ->orderBy('aqi.id', 'ASC')
            ->setParameter('users', $userIds);

        return $query->getQuery()->getResult();
    }
    
    /**
     * @todo implement
     */
    public function processAnswersAction() 
    {
        $query = $this->_getEntityManager()->createQueryBuilder()
            ->select('r')
            ->from('Application_Model_Entities_Round', 'r')
            ->where('r.current_question IS NOT NULL');

        $rounds = $query->getQuery()->getResult();

        $now = new DateTime('now');

        foreach($rounds as $_round) {
            $roundQuestion = $_round->getCurrentQuestion();
            if ($roundQuestion->getSentTime()->add($_round->getDuration()) >= $now) {
                continue;
            }
            $this->_getLogger()->log(__LINE__, 0);
            $league = $roundQuestion->getRound()->getLeague();
            $queueItems = $this->_getQueueItemsByUsers($league->getUsers());
            
            
            $processedUsers = array();
            foreach ($queueItems as $_queueItem) {
                $this->_getEntityManager()->remove($_queueItem);
                $this->_getLogger()->log(__LINE__, 0);
                
                if(in_array($_queueItem->getUser()->getId(), $processedUsers)) {
                    continue;
                } else {
                    $processedUsers[] = $_queueItem->getUser()->getId();
                }
                
                $question = $roundQuestion->getQuestion();
                
                if (!$question->isCorrect($_queueItem->getMessage())) {
                    $this->_getLogger()->log(__LINE__, 0);
                    continue;
                }
                
                if (is_null($roundQuestion->getWinnerOne())) {
                    $this->_getLogger()->log(__LINE__, 0);
                    $roundQuestion->setWinnerOne($_queueItem->getUser());
                    $this->_getEntityManager()->persist($roundQuestion);
                    continue;
                }
                
                if (is_null($roundQuestion->getWinnerTwo())
                        && $roundQuestion->getWinnerOne()->getId() != $_queueItem->getUser()->getId()) {
                   $roundQuestion->setWinnerTwo($_queueItem->getUser());
                   $this->_getEntityManager()->persist($roundQuestion); 
                }

            }
            $apiKey = $this->_getConfig()->get('clockworksms')->get('apikey');
            $clockwork = new Clockwork_Clockwork($apiKey);
            $roundQuestion->end($clockwork);
            
            $this->_getEntityManager()->flush();
        }
        die('Cron success');
    }
}