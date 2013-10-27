<?php
use Doctrine\ORM\EntityRepository;

class Application_Model_Repositories_LeagueRepository extends EntityRepository
{
    /**
     * @author Chris Atty
     * @param string $code
     * @return Application_Model_Entities_League
     */
    public function findLeagueByCode($code) {
        return $this->findOneByCode($code);
    }
    
    public function createLeague($name) {
        $league = new Application_Model_Entities_League;
        $league->setName($name);    
        $league->generateCode();
        $this->getEntityManager()->persist($league);
        $this->getEntityManager()->flush();
        $this->_assignNewRoundToLeague($league);
        return $league;
    }
    public function saveLeague($league) {
        $this->getEntityManager()->persist($league);
        $this->getEntityManager()->flush();
        return $league;
    }
    
    private function _assignNewRoundToLeague($league)
    {
        $roundRepository = $this->getEntityManager()->getRepository('Application_Model_Entities_Round');
        $round = $roundRepository->createRound('120',new DateTime('now'),$league);
        $league->setCurrentRound($round);
        $this->saveLeague($league);
    }
    
    public function test()
    {
        
    }
}