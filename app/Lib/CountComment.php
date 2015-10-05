<?php
class CountComment
{
    public function countCommentFB($url) {
        $url = Router::url('/', true).$url;
        $json = json_decode(file_get_contents('https://graph.facebook.com/?ids=' . $url));

        $count = isset($json->$url->comments) ? $json->$url->comments : 0;

        return $count;
    }
}