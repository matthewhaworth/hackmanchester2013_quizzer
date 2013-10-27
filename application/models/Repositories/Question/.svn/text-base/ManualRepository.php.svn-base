<?php
use Doctrine\ORM\EntityRepository;

class Application_Model_Repositories_Question_ManualRepository extends EntityRepository
{
    public function popQuestion() {
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select('q')
            ->from('Application_Model_Entities_Question_Manual', 'q')
            ->orderBy('q.created_at', 'ASC')
            ->setMaxResults(1);

        $question = $query->getQuery()->getOneOrNullResult();
        if ($question) {
            $em->remove($question);
            $em->flush();
            return $question;
        } else {
            return false;
        }
    }
}