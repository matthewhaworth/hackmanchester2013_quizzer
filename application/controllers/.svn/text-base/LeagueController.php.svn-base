<?php
class LeagueController extends Quizzer_Controller_Abstract
{
    public function indexAction()
    {
        $this->_requireLogin();
    }
    public function createAction()
    {
        $this->_requireLogin();
        $request = $this->getRequest();
        if($request->getParam('name'))
        {
            $leagueRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_League');
            /** @var leagueRespository Application_Model_Repositories_LeagueRepository */
            $league = $leagueRespository->createLeague($request->getParam('name'));
            $user = $this->_getLoggedInUser();
            $user->setLeague($league);
            $userRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
            $userRespository->saveUser($user);
            $this->view->league = $league;
        }
    }
    public function settingsAction()
    {
        
    }
    public function updateAction()
    {
        $request = $this->getRequest();
        if($request->getParam('name'))
        {
            $user = $this->_getLoggedInUser();
            $leagueRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_League');
            $league = $user->getLeague();
            $league->setName($request->getParam('name'));
            $leagueRespository->saveLeague($league);
        }
        $this->_forward('settings');
    }
}