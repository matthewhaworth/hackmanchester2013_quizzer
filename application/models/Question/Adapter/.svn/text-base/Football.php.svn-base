<?php
class Application_Model_Question_Adapter_Football
    extends Application_Model_Question_Adapter_Abstract
        implements Application_Model_Question_Adapter_Interface
{
    public function getQuestion() {
        /*$xmlString = $this->getXMLFile();
        die($xmlString);
        $xml = simplexml_load_string($xmlString);*/
        $xml = $this->getXMLFile();
        foreach($xml->xpath('/matchesCompetition/match') as $match)
        {
            if( $match->status != 'Full Time')
            {
                $dom=dom_import_simplexml($match);
                $dom->parentNode->removeChild($dom);
            }
        }
        $result = $xml->xpath('/matchesCompetition/match');
        $randomMatch = rand(1,count($result));
        $counter = 0;
        foreach($xml->xpath('/matchesCompetition/match') as $match)
        {
            $counter = $counter + 1;
            if( $randomMatch === $counter)
            {
                if( $match->status == 'Full Time')
                {
                    $questionString = 'What was the result of ' 
                            . $match->homeTeamName 
                            . ' vs ' . $match->awayTeamName
                            . ' on ' . $match->date . '.';
                    $result = $match->homeTeamScore . '-' . $match->awayTeamScore;
                    $array = array($result);
                    $rand = rand(1,4);
                    $i = 0;
                    do {
                        $questionString = $questionString . ' ';
                        $i = $i + 1;
                        if( $i == $rand)
                        {
                           $questionString = $questionString .  $i . ')' . $result;
                           $answer = $i;
                        }
                        else
                        {
                            $score = rand(0,4) . '-' . rand(0,4);
                            if( in_array($score,$array))
                            {
                                $i = $i - 1;
                            }
                            else
                            {
                                $questionString = $questionString .  $i . ')' . $score;
                                $array[] = $score;
                            }
                        }
                    } while ($i < 4);
                    //die($questionString);
                    $question = new Application_Model_Entities_Question();
                    $question->setQuestion($questionString);
                    $question->setAnswer($answer);
                    $question->setType('exact');
                    return $question;
                }
           }
        }
        return false;
    }
    protected function getXMLFile()
    {
        $currentDate = new DateTime();
        $month = $currentDate->format('m');
        $url = 'http://www.footballwebpages.co.uk/matches.xml?comp=20&month=' . $month;
        $xml = simplexml_load_file($url);
        return $xml;
    }
    
}

