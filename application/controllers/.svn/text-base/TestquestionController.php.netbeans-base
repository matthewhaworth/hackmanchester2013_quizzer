<?php
class TestquestionController extends Quizzer_Controller_Abstract {
    public function distanceAction()
    {
        $distance = new Application_Model_Question_Adapter_Distance($this->_getEntityManager());
        $distance->getQuestion();
    }
    public function bikeAction()
    {
        $distance = new Application_Model_Question_Adapter_Biketime($this->_getEntityManager());
        $distance->getQuestion();
    }
    public function wordAction()
    {
        $word = new Application_Model_Question_Adapter_Word($this->_getEntityManager());
        $word->getQuestion();
    }
    public function radioAction()
    {
        $word = new Application_Model_Question_Adapter_Radio($this->_getEntityManager());
        $word->getQuestion();
    }
}
