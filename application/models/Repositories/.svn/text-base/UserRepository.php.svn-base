<?php
use Doctrine\ORM\EntityRepository;

class Application_Model_Repositories_UserRepository extends EntityRepository
{
    /**
     * @author Chris Atty
     * @param string $email
     * @return Application_Model_Entities_User
     */
    public function findUserByEmail($email) {
        return $this->findOneByEmail($email);
    }
    
    /**
     * @author Chris Atty
     * @param string $phoneNumber
     * @return Application_Model_Entities_User
     */
    public function findUserByPhone($phoneNumber) {
        return $this->findOneByPhone($phoneNumber);
    }
    
    public function createUser($email,$password,$phoneNo,$name) {
        $user = new Application_Model_Entities_User;
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setPhone($phoneNo);
        $user->setName($name);        
        
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return $user;
    }
    public function saveUser($user) {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return $user;
    }
    
    
    public function test()
    {
        
    }
}