<?php
use Doctrine\ORM\EntityRepository;

class Application_Model_Repositories_RoundRepository extends EntityRepository
{
    /**
     * @author Chris Atty
     * @param string $id
     * @return Application_Model_Entities_Round
     */
    public function findRoundById($Id) {
        return $this->findOneById($Id);
    }
    
    public function createRound($duration,$start_date,$league) {
        $round = new Application_Model_Entities_Round;
        $round->setDuration($duration);
        $round->setStartDate($start_date);
        $round->setLeague($league);
        $this->getEntityManager()->persist($round);
        $this->getEntityManager()->flush();
        return $round;
    }
    public function saveRound($round) {
        $this->getEntityManager()->persist($round);
        $this->getEntityManager()->flush();
        return $round;
    }
    
    
    public function test()
    {
        
    }
}