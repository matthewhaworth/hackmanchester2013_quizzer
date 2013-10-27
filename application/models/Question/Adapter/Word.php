<?php
class Application_Model_Question_Adapter_Word
    extends Application_Model_Question_Adapter_Abstract
        implements Application_Model_Question_Adapter_Interface
{
    public function getQuestion() {
        /*$xmlString = $this->getXMLFile();
        die($xmlString);
        $xml = simplexml_load_string($xmlString);*/
        $xml = $this->getXMLFile();
        $result = $xml->xpath('/rss/channel/item');
        $answer = count($result);
        $questionString = 'What is the word of the day on wordsmith.org?';
        $randoms = array();
        $rand1 = rand(1,$answer-1);
        $randoms[] = $rand1;
        $done = false;
        do{
            $rand2 = rand(1,$answer-1);
            if( in_array($rand2,$randoms)){
                $done = false;
            }else{
                $randoms[] = $rand2;
                $done = true;
            }
        }while($done==false);
        $done = false;
        do{
            $rand3 = rand(1,$answer-1);
            if(in_array($rand3,$randoms)){
                $done = false;
            }else{
                $randoms[] = $rand3;
                $done = true;
            }
        }while($done==false);
        $i = 0;
        $correct= '';
        $answers = array();
        foreach($xml->xpath('/rss/channel/item') as $item )
        {
            $i = $i + 1;
            if($i == $rand1 || $i == $rand2 || $i == $rand3 )
            {
                $answers[] = $item->title;
            }
            elseif($i == $answer )
            {
                $answers[] = $item->title;
                $correct = $item->title;
            }
        }
        shuffle($answers);
        $i = 0;
        $index = 0;
        foreach($answers as $answer )
        {
            $i = $i + 1;
            $questionString = $questionString . ' '. (string)$i . ')' . $answer;
            if($answer == $correct ){
                $index = $i;
            }
        }
        die($questionString);
        $question = new Application_Model_Entities_Question();
        $question->setQuestion($questionString);
        $question->setAnswer((string)$index);
        $question->setType('exact');
        return $question;
}
    protected function getXMLFile()
    {
        $url = 'http://wordsmith.org/awad/rss2.xml';
        $xml = simplexml_load_file($url);
        return $xml;
    }
    
}

