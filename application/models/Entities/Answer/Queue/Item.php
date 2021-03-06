<?php
/**
 * @Entity @Table(name="answer_queue_item") @HasLifecycleCallbacks
 */
class Application_Model_Entities_Answer_Queue_Item
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /**
     * @OneToOne(targetEntity="Application_Model_Entities_User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected $user;
    
    /** @Column(type="string") */
    protected $message;
    
    public function getId() {
        return $this->id;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
        return $this;
    }
    
    /** @PrePersist */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime("now");
    }
}