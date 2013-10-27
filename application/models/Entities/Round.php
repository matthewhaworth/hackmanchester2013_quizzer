<?php
/**
 * @Entity(repositoryClass="Application_Model_Repositories_RoundRepository") @Table(name="round") @HasLifecycleCallbacks
 */
class Application_Model_Entities_Round
{
    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /**
     * @todo make this many to one
     * @OneToOne(targetEntity="Application_Model_Entities_League", inversedBy="current_round")
     * @JoinColumn(name="league_id", referencedColumnName="id")
     **/
    protected $league;
    
    /** @Column(type="datetime", nullable="true") */
    protected $start_date;
    
    /** @Column(type="integer", nullable="true") */
    protected $duration = 600;
    
    /**
     * @OneToOne(targetEntity="Application_Model_Entities_Round_Question")
     * @JoinColumn(name="current_question_id", referencedColumnName="id", nullable="true")
     **/
    protected $current_question;
    
    /**
     * @OneToMany(targetEntity="Application_Model_Entities_Round_Question", mappedBy="round")
     **/
    protected $questions;
    
    public function getId() {
        return $this->id;
    }

    public function getLeague() {
        return $this->league;
    }

    public function setLeague($league) {
        $this->league = $league;
        return $this;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function setStartDate($start_date) {
        $this->start_date = $start_date;
        return $this;
    }

    public function getDuration() {
        return new DateInterval("PT{$this->duration}S");
    }

    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

    public function getCurrentQuestion() {
        return $this->current_question;
    }

    public function setCurrentQuestion($current_question) {
        $this->current_question = $current_question;
        return $this;
    }
    
    public function getQuestions() {
        return $this->questions;
    }

    public function setQuestions($questions) {
        $this->questions = $questions;
        return $this;
    }
    
    /** @PostPersist */
    public function assignQuestionsToRound()
    {
        $questionsInRound = 10;
        $now = new DateTime('now');
        $roundEndDate = new DateTime('now');
        $roundEndDate = $roundEndDate->add(new DateInterval('PT1H'));
        $roundQuestions = array();
        for ($questionCount = 0; $questionCount < $questionsInRound; $questionCount++) {
            $randomTime = mt_rand($now->getTimestamp(), $roundEndDate->getTimestamp());
            $roundQuestion = new Application_Model_Entities_Round_Question;
            $randomDateTime = new DateTime();
            $randomDateTime->setTimestamp($randomTime);
            $roundQuestion->setScheduledTime($randomDateTime);
            $roundQuestion->setRound($this);
            $roundQuestions[] = $roundQuestion;
            $this->getEntityManager()->persist($roundQuestion);
        }
        
        $this->getEntityManager()->flush();
    }
    
    public function getEntityManager()
    {
        return Zend_Registry::get('doctrine_em');
    }
}
