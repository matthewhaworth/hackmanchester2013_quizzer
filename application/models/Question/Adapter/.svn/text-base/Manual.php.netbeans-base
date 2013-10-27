<?php
class Application_Model_Question_Adapter_Manual
    extends Application_Model_Question_Adapter_Abstract
        implements Application_Model_Question_Adapter_Interface
{
    public function getQuestion() {

        $manualQuestion = $this->getEntityManager()
            ->getRepository('Application_Model_Entities_Question_Manual')
            ->popQuestion();
        
        /** var $question Application_Model_Repositities_Question_Manual */
        if($manualQuestion) {
            $question = new Application_Model_Entities_Question();
            $question->setQuestion($manualQuestion->getQuestion());
            $question->setAnswer($manualQuestion->getAnswer());
            $question->setType($manualQuestion->getType());
            $question->setErrorMargin($manualQuestion->getErrorMargin());
            return $question;
        } else {
            return false;
        }
        
    }
    
}

