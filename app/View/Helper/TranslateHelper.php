<?php
App::uses('AppHelper', 'View');

class TranslateHelper extends AppHelper
{
    public $helpers = array('Time');

    public function trans($string) {
        $timeTrans = $this->Time->timeAgoInWords($string, array('end' => '+48 hour'), true);

        $timeTrans = explode(" ", $timeTrans);

        $resultTime = '';

        foreach($timeTrans as $eachTime) {
            $resultTime .= __($eachTime).' ';
        }

        return $resultTime;
    }
}