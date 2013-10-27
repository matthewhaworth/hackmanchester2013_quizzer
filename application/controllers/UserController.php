<?php
class UserController extends Quizzer_Controller_Abstract
{
        public function indexAction()
        {
            $this->_requireLogin();
            $user = $this->_getLoggedInUser();
            if( $user->getLeague() ){
                $leagueUsers = $user->getLeague()->getUsers();
                $round = $user->getLeague()->getCurrentRound();
                $questions = $round->getQuestions();
                $this->view->userScores = array();
                $this->view->leagueUsers = array();
                foreach($leagueUsers as $user)
                {
                    $this->view->userScores[$user->getId()] = 0;
                    $this->view->leagueUsers[$user->getId()] = $user;
                }
                foreach($questions as $question )
                {
                    if(!$question->getWinnerOne() || !$question->getSentTime())
                    {
                        continue;
                    }
                    $winnerOneSet = false;
                    $winnerTwoSet = false;
                    foreach($this->view->userScores as $k => $score )
                    {
                        $winnerOne = $question->getWinnerOne();
                        if($winnerOne)
                        {
                            if($winnerOne->getId() == $k )
                            {
                                $this->view->userScores[$k] = $this->view->userScores[$k] + 5;
                                $winnerOneSet = true;
                            }
                        }
                        $winnerTwo = $question->getWinnerTwo();
                        if($winnerTwo)
                        {
                            if($winnerTwo->getId() == $k )
                            {
                                $score = $score + 3;
                                $this->view->userScores[$k] = $this->view->userScores[$k] + 3;
                                $winnerTwoSet = true;
                            }
                        }
                        if($winnerOneSet && $winnerTwoSet )
                        {
                            break;
                        }
                    }
                }
                arsort($this->view->userScores);
            }
        }
        public function detailsAction()
        {
            $this->_requireLogin();
        }
        public function signUpAction()
        {
            $this->_logoutUser();
            $request = $this->getRequest();
            $this->view->email = $request->getParam("email");
            $this->view->password = $request->getParam("password");
            $this->view->phone = $request->getParam("phone");
            $this->view->name = $request->getParam("name");
        }
	public function signUpPostAction()
	{
            $request = $this->getRequest();
            $error = false;
            $userRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
            /** @var userRespository Application_Model_Repositories_UserRepository */
            $email = $request->getParam("email");
            $password = $request->getParam("password");
            $phone = $request->getParam("phone");
            $name = $request->getParam("name");
            /* Should do other validation - regex */
            if( $email == '' || $password == '' || $phone == '' || $name == '' )
            {
                $error = true;
            }
            if( $error == false )
            {
                $user = $userRespository->createUser($email,$password,$phone,$name);
                if( $user && $user->getId() )
                {
                    $this->view->createdUser = true;
                }
                else
                {
                    $error = true;
                }
            }
            if( $error == true )
            {
                $this->_forward('sign-up');
            }
	}
        public function loginAction()
        {
            $request = $this->getRequest();
            if(!$request->isPost())
            {
                $this->errorLogon();
                return;
            }
            $email = $request->getParam("email");
            if( $email == '')
            {
                $this->errorLogon();
                return;
            }
            $password = $request->getParam("password");
            $userRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
            $user = $userRespository->findUserByEmail($email);
            if(isset($user))
            {
                if(md5($password) === $user->getPassword())
                {
                    $this->setLogon($user);
                }
                else
                {
                    $this->errorLogon();
                }
            }else
            {
                $this->errorLogon();
            }
        }
        private function setLogon($user)
        {
            $this->_getUserSession()->user_id = $user->getId();
            $this->_redirect('/user');
        }
        private function errorLogon()
        {
           $this->_redirect('/'); 
        }
        public function logoutAction()
        {
            $this->_logoutUser();
            $this->_redirect('/');
        }
        public function updateAction()
        {
            $this->_requireLogin();
            $request = $this->getRequest();
            $user = $this->_getLoggedInUser();
            $email = $request->getParam('email');
            $phone = $request->getParam('phone');
            $name = $request->getParam('name');
            $password = $request->getParam('password');
            $repeatPassword = $request->getParam('password1');
            if($email) /*should validate */
            {
                $user->setEmail($email);
            }
            if($name)
            {
                $user->setName($name);
            }
            if($phone) /*should validate */
            {
                $user->setPhone($phone);
            }
            if($password) /*should validate */
            {
                if( $password === $repeatPassword )
                {
                    $user->setPassword($password);
                }
                else{
                    $this->view->error = 'Passwords do not match';
                }
            }
            $userRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
            $userRespository->saveUser($user);
            $this->_forward('details');
        }
        public function joinAction()
        {
            $request = $this->getRequest();
            $code = $request->getParam('code');
            if( $code )
            {
                $leagueRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_League');
                $league = $leagueRespository->findLeagueByCode($code);
                if( $league && $league->getId() )
                {
                    $user = $this->_getLoggedInUser();
                    $user->setLeague($league);
                    $userRespository = $this->_getEntityManager()->getRepository('Application_Model_Entities_User');
                    $userRespository->saveUser($user);
                }
                else 
                {
                    $this->view->error = 'League not found';
                }
            }
            $this->_forward('index');
        }
        public function statisticsAction()
        {
            $this->_requireLogin();
            $request = $this->getRequest();
            $id = $request->getParam('id');
            if( $id ){
                $user = $this->_getEntityManager()->find('Application_Model_Entities_User',$id);
            }else{
                $user = $this->_getLoggedInUser();
            }
            $league = $user->getLeague();
            $round = $league->getCurrentRound();
            $questions = $round->getQuestions();
            $this->view->questions = 0;
            $this->view->winnerOne = 0;
            $this->view->winnerTwo = 0;
            $this->view->points = 0;
            foreach($questions as $question)
            {
                if(!$question->getSentTime())
                {
                    continue;
                }
                $this->view->questions = $this->view->questions + 1;
                if($question->getWinnerOne() == $user)
                {
                    $this->view->winnerOne = $this->view->winnerOne + 1;
                    $this->view->points =  $this->view->points + 5;
                }
                elseif($question->getWinnerTwo() == $user)
                {
                    $this->view->winnerTwo = $this->view->winnerTwo + 1;
                    $this->view->points =  $this->view->points + 3;
                }
            }
            $this->view->statUser = $user;
        }
}