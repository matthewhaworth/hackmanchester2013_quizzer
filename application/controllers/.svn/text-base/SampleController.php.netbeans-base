<?php
class SampleController extends Quizzer_Controller_Abstract 
{
    public function createUsersAction()
    {
        $users = array();
        
        $_user = new Application_Model_Entities_User;
        $_user->setEmail('test1@test.com');
        $_user->setName('test_1');
        $_user->setPhone('07791757036');
        $_user->setPassword('123123');
        $users[] = $_user;
        
        $_user = new Application_Model_Entities_User;
        $_user->setEmail('test2@test.com');
        $_user->setName('test_2');
        $_user->setPhone('07791757036');
        $_user->setPassword('123123');
        $users[] = $_user;
        
        $_user = new Application_Model_Entities_User;
        $_user->setEmail('test3@test.com');
        $_user->setName('test_3');
        $_user->setPhone('07791757036');
        $_user->setPassword('123123');
        $users[] = $_user;
        
        $_user = new Application_Model_Entities_User;
        $_user->setEmail('test4@test.com');
        $_user->setName('test_4');
        $_user->setPhone('07791757036');
        $_user->setPassword('123123');
        $users[] = $_user;
        
        foreach ($users as $_user) {
            $this->_getEntityManager()->persist($_user);
        }
        
        $this->_getEntityManager()->flush();
        
        die('created users.');
    }
    
    protected function _getUserRepository()
    {
        return $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
    }
    
    public function createLeaguesAction()
    {
        $leagues = array();
        
        $_league = new Application_Model_Entities_League;
        $_league->setName('test_league_1');
        $_league->generateCode();
        
        $users = array();
        $users[] = $this->_getUserRepository()->findOneByName('test_1');
        $users[] = $this->_getUserRepository()->findOneByName('test_2');
        foreach ($users as $_user) {
            $_user->setLeague($_league);
            $this->_getEntityManager()->persist($_user);
        }
        $_league->setUsers($users);
        $leagues[] = $_league;
        
        $_league = new Application_Model_Entities_League;
        $_league->setName('test_league_2');
        $_league->generateCode();
        
        $users = array();
        $users[] = $this->_getUserRepository()->findOneByName('test_3');
        $users[] = $this->_getUserRepository()->findOneByName('test_4');
        foreach ($users as $_user) {
            $_user->setLeague($_league);
            $this->_getEntityManager()->persist($_user);
        }
        $_league->setUsers($users);
        $leagues[] = $_league;
        
        foreach ($leagues as $_league) {
            $this->_getEntityManager()->persist($_league);
        }
        
        $this->_getEntityManager()->flush();
        
        die('created leagues.');
    }
    
    protected function _getLeagueRepository()
    {
        return $this->_getEntityManager()->getRepository('Application_Model_Entities_League');
    }
    
    public function createRoundsAction()
    {
        $rounds = array();
        
        $_round = new Application_Model_Entities_Round;
        $_round->setStartDate(new DateTime('now'));
        $_league = $this->_getLeagueRepository()->findOneByName('test_league_1');
        $_round->setLeague($_league);
        $rounds[] = $_round;
        
        $_round = new Application_Model_Entities_Round;
        $_round->setStartDate(new DateTime('now'));
        $_league = $this->_getLeagueRepository()->findOneByName('test_league_2');
        $_round->setLeague($_league);
        $rounds[] = $_round;
        
        foreach ($rounds as $_round) {
            $this->_getEntityManager()->persist($_round);
        }
        
        $this->_getEntityManager()->flush();
        
        die('created rounds.');
    }
}