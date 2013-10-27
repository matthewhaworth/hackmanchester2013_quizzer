<?php
class IndexController extends Quizzer_Controller_Abstract
{
    public function indexAction()
    {
        $this->_getConfig();
        $user = $this->_getLoggedInUser();
        if( $user && $user->getId() )
        {
            $this->_forward('index', 'user');
        }
    }
}