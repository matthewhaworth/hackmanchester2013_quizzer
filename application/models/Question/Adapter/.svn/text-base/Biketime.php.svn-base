<?php
class Application_Model_Question_Adapter_Biketime
    extends Application_Model_Question_Adapter_Abstract
        implements Application_Model_Question_Adapter_Interface
{
    public function getQuestion() {

        $question = new Application_Model_Entities_Question();
        $city = $this->getRandomCity();
        $done=false;
        do{
           $city2 = $this->getRandomCity();
           if($city != $city2)
           {
               $done=true;
           }
        }while($done==false);
        $xml = $this->getXMLFile($city,$city2);
        $questionString = 'How long approximately in seconds would it take you to cycle from ' 
                . $city . ' to ' 
                . $city2 . '?';
        $question->setQuestion($questionString);
        $answer=0;
        foreach($xml->xpath('/DistanceMatrixResponse/row/element/duration/value') as $answer)
        {
            $answer = $answer;
        }
        $question->setAnswer((string)$answer);
        $question->setType('nearest');
        $question->setErrorMargin('5');
        return $question;
    }
    protected function getXMLFile($city,$city2)
    {
        $url = 'http://maps.googleapis.com/maps/api/distancematrix/xml?sensor=false&mode=bicycling&origins=' . $city . '&destinations='. $city2;
        $xml = simplexml_load_file($url);
        return $xml;
    }
    
    protected function getCities()
    {
        $cities = array();
        $cities[] = 'Brighton';
        $cities[] = 'Grimsby';
        $cities[] = 'Hull';
        $cities[] = 'Aberdeen';
        $cities[] = 'Plymouth';
        $cities[] = 'Stoke';
        $cities[] = 'Gillingham';
        $cities[] = 'Bury';
        $cities[] = 'Yeovil';
        $cities[] = 'York';
        $cities[] = 'Watford';
        return $cities;
    }
    
    protected function getRandomCity()
    {
        $cities = $this->getCities();
        $count = count($cities);
        $rand = rand(0,$count-1);
        $city =  $cities[$rand];
        return $city;
    }
}
