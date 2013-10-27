<?php
/**
 * @Entity(repositoryClass="Application_Model_Repositories_UserRepository") @Table(name="user") 
 */
class Application_Model_Entities_User
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $email;
    
    /** @Column(type="string") */
    protected $password;
    
    /** @Column(type="string") */
    protected $phone;
    
    /** @Column(type="string") */
    protected $name;
    
    /**
     * @ManyToOne(targetEntity="Application_Model_Entities_League", inversedBy="users")
     * @JoinColumn(name="league_id", referencedColumnName="id")
     **/
    protected $league;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
        
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone_number) {
        $this->phone = $phone_number;
        return $this;
    }
    
    public function getId() {
        
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = strtolower($email);
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function checkPassword($input) {
        return md5($input) == $this->getPassword();
    }

    public function setPassword($password) {
        $this->password = md5($password);
        return $this;
    }
    
    /**
     * @return Application_Model_Entities_League
     */
    public function getLeague() {
        return $this->league;
    }

    public function setLeague($league) {
        $this->league = $league;
        return $this;
    }
}