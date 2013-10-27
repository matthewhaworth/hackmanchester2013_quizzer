<?php
/**
 * @Entity(repositoryClass="Application_Model_Repositories_LeagueRepository") @Table(name="league") @HasLifecycleCallbacks
 */
class Application_Model_Entities_League
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $name;

    /** @Column(type="string") */
    protected $code;
    
    /**
     * @OneToMany(targetEntity="Application_Model_Entities_User", mappedBy="league")
     **/
    protected $users;
    
    /**
     * @OneToOne(targetEntity="Application_Model_Entities_Round", mappedBy="league")
     **/
    protected $current_round;
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function generateCode() {
        if (is_null($this->code)) {
            $this->code = substr(md5(rand(0,10000000)), 0, 5);
        }
    }

    public function getCode() {
        return $this->code;
    }    

    public function getUsers() {
        return $this->users;
    }

    public function setUsers($users) {
        $this->users = $users;
        return $this;
    }
    
    /**
     * @return Application_Model_Entities_Round
     */
    public function getCurrentRound() {
        return $this->current_round;
    }

    public function setCurrentRound($current_round) {
        $this->current_round = $current_round;
        return $this;
    }
}