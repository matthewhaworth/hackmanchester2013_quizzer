<?php
/**
 * @Entity @Table(name="question") @HasLifecycleCallbacks
 */
class Application_Model_Entities_Question
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string") */
    protected $question;
    
    /** @Column(type="string") */
    protected $type;
    
    /** @Column(type="integer", nullable="true") */
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
    
    public function getAnswerFactory()
    {
        return new Application_Model_Answer_Factory;
    }
    
    public function isCorrect($answer)
    {
        switch ($this->getType()) {
            case 'nearest':
                // Assume answer is int
                $answer = (int) $answer;
                
                $highAnswer = $this->getAnswer() * (1 + $this->getErrorMargin() / 100);
                $lowAnswer = $this->getAnswer() * (1 - $this->getErrorMargin() / 100);
                
                return $answer < $highAnswer && $answer > $lowAnswer;
                break;
            case 'exact':
                return strtolower($answer) === strtolower($this->getAnswer());
                break;
        }
        
        return false;
    }

    /** @PrePersist */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime("now");
    }
}