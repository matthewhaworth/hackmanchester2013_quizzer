<?php
/**
 * @Entity(repositoryClass="Application_Model_Repositories_Question_ManualRepository") @Table(name="question_manual") @HasLifecycleCallbacks
 */
class Application_Model_Entities_Question_Manual
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $question;
    
    /** @Column(type="string") */
    protected $type;
    
    /** @Column(type="string", nullable="true") */
    protected $error_margin;
    
    /** @Column(type="string") */
    protected $answer;
    
    /** @Column(type="datetime") */
    protected $created_at;
    
    public function getId() {
        
        return $this->id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getAdapterType() {
        return $this->adapter_type;
    }

    public function setAdapterType($adapter_type) {
        $this->adapter_type = $adapter_type;
        return $this;
    }

    public function getErrorMargin() {
        return $this->error_margin;
    }

    public function setErrorMargin($error_margin) {
        $this->error_margin = $error_margin;
        return $this;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
        return $this;
    }

    /** @PrePersist */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime("now");
        return $this;
    }
}