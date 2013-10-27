<?php
class Application_Model_Question_Adapter_Radio
    extends Application_Model_Question_Adapter_Abstract
        implements Application_Model_Question_Adapter_Interface
{
    public function getQuestion() {
        $xml = $this->getXMLFile();
        $i = 0;
        $answers = array();
        $name= '';
        foreach($xml->xpath('/artists_chart/artists/artist') as $artist)
        {
            $i = $i + 1;
            if( $i = 1){
                $name = $artist->name;
                $answers[] = $name;
                $plays = $artist->plays;
            }
            elseif($artist->plays != $plays ){
                $answers[] = $artist->name;
            }
            if( count($answers) == 4){
                    break;
            }
        }
        shuffle($answers);
        $questionString = 'Which artist is most played on radio 1 in the last 7 days?';
        $i = 0;
        $index = 0;
        foreach($answers as $answer )
        {
            $i = $i + 1;
            $questionString = $questionString . ' '. (string)$i . ')' . $answer;
            if($answer == $name ){
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
        $url = 'http://www.bbc.co.uk/programmes/music/artists/charts.xml';
        $xml = simplexml_load_file($url);
        return $xml;
    }
    
}
