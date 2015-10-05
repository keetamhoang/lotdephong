<?php
App::uses('AppHelper', 'View');

class SortHelper extends AppHelper
{
    public function sort($param) {
        $sort = isset($this->params['url']['sort'])?$this->params['url']['sort']:'id';
        $direction = isset($this->params['url']['direction'])?$this->params['url']['direction']:'asc';

        return ($sort == $param)?('<i class="fa fa-caret-'.($direction == 'asc'?'down':'up').'"></i>'):'';
    }
}