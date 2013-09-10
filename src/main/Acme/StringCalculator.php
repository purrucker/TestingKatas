<?php

namespace Acme;

class StringCalculator
{
    public function add($string="")
    {
        $delimiter = $this->findDelimiter($string);
        $string = $this->findNumbers($string);

        $string = str_replace("\n",$delimiter,$string);
        $numbers = explode($delimiter,$string);
        $sum = 0;
        $negatives = array();
        foreach($numbers as $number) {
            if((int) $number < 0) {
                $negatives[] = (int) $number;
            } else {
                $sum += (int) $number;
            }
        }
        if(!empty($negatives)) {
            $string = "";
            for($i = 0; $i < sizeof($negatives); $i++) {
                if($i == sizeof($negatives)-1) {
                    $string .= $negatives[$i];
                } else {
                    $string .= $negatives[$i].",";
                }
            }
            throw new \InvalidArgumentException("No negative numbers allowed ($string)!");
        } else {
            return $sum;
        }
    }

    /**
     * @param $string
     * @return array
     */
    private function findDelimiter($string)
    {
        $delimiter = ",";
        if (strpos($string, "//") !== false) {
            $delimiter = substr($string, 2, strpos($string, "\n") - 2);
        }
        return $delimiter;
    }

    private function findNumbers($string)
    {
        if (strpos($string, "//") !== false) {
            $string = substr($string,strpos($string, "\n"));
        }
        return $string;
    }
}
