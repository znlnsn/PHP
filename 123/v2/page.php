<?php
if(!function_exists('paging')){
    function paging($total,$realTotal,$displayPG=20,$url=''){
        global $page,$firstCount,$pageNav,$_SERVER;
        $GLOBALS["displayPG"]=$displayPG;
        $page=$_GET["page"] ?? 1;
        if(!$url){
            $url=$_SERVER["REQUEST_URI"];
        }
        $page_url=parse_url["query"] ?? '';
        if($url_query){
            $url_query=$parse_url["query"] ?? '';
        }
    }
}