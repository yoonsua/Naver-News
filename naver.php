<?php
$sch = "";
if( isset($_GET['sch']) ) $sch = $_GET['sch'];
$news = "http://newssearch.naver.com/search.naver?where=rss&query={$sch}&field=0&nx_search_query=&nx_and_query=&nx_sub_query=&nx_search_hlquery=";
$xml = simplexml_load_file($news);
//var_dump($xml);
$channel = $xml->channel;
$newslist = $channel->item;
$data = array();
$no = 0;
foreach( $newslist as $news ){
	$data[$no] = array(
		'title'=> $news->title,
		'author'=>$news->author,
		'link'=>$news->link,
		'category' => $news->category,
		'pubDate' => $news->pubDate
	);
	$no++;
}
$json = json_encode($data, JSON_UNESCAPED_UNICODE);
echo $json;