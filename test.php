<?php

class Vineyards {

    private $wine   = array();
    private $people = array();

    public function processWine() {
       try{
        $this->readPeopleWineFromFile();//read data wine and people from file given as input and I use first input given by 
        return $this->processDistribute();// prosess for wine distribution among peoples
          }catch (Exception $e)
       {
         return $e->getMessage();  
       }
    }
  private function readPeopleWineFromFile()
  {    ini_set('max_execution_time', 0);//unlimited time execution
       ini_set('memory_limit', '-1');  //unlimited buffer memory
       try{
       $handle = @fopen('file.txt', 'r');//file given at root level and 
       $handle = @fopen('person_wine_3.txt', 'r');//file given at root level
        if ($handle) {
            while (!feof($handle)) {
                $buffer                     = fgets($handle);//read file line by line
                $exploded_data              = explode("\t", $buffer);//explode line by tab
                $people[$exploded_data[0]]  = !empty($exploded_data[0])? $exploded_data[0]:'';//get people and store as unique guy,for create unique value store in array keys as well
                $wine[$exploded_data[1]]    =!empty($exploded_data[1])? $exploded_data[1]:'';//get wine and store as unique wine,for create unique value store in array keys as well
            }
            fclose($handle);
        }
//print_r($wine);die;
        $this->wine   = $wine;//set wine for use in other function
        $this->people = $people;//set people for use in other function
       } catch (Exception $e)
       {
         return $e->getMessage();  
       }
  }

  private function processDistribute() {
        try{
        $result             = array();
        $unique_wine        = $this->wine;
        $unique_people      = $this->people;
        $count_unique_people= count($unique_people);
        $count_unique_wine  = count($unique_wine);
        $data               = '';
        foreach ($unique_people as $guys) {
        $init = 0;
        foreach ($unique_wine as $wine) {
                $data.=nl2br($guys . "\t" . $wine);
                $init++;
                if ($init >= 3) {
                    break;
                }
            }
        }
        $result['total_wine_sell']       = $count_unique_wine;
        $result['wine_distibute_people'] = $data;
        return $result;
       }catch (Exception $e)
       {
         return $e->getMessage();  
       }
    }

}

    $obj    = new Vineyards();
    $result = $obj->processWine();
echo nl2br("Total Unique wine Sell-->" . $result['total_wine_sell'] . "\n");
echo nl2br("People and their Wine-->" . "\n");
echo nl2br("People &nbsp;&nbsp;Wine" . "\n" . $result['wine_distibute_people']);
?>