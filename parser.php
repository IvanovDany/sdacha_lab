<?php
set_time_limit(0);

libxml_use_internal_errors(true);

$start = microtime(true);

$url = 'https://www.freelancer.com/jobs/';
$refererUrl = 'https://www.freelancer.com';

$data = curlGetContents($url, $refererUrl);

?><pre><?print_r($data)?></pre><?
if ($data['code'] == 200){

  $doc = new DOMDocument();
  $doc->loadHTML($data['data']);
  $xPath = new DOMXpath($doc);

  $startPage = 1;
  $endPage = 3;

  echo 'Парсер начал работу...<br>';
 
 while($startPage <= $endPage){
    $link = "{$url}$startPage/?sort=budget_max";

    $data = curlGetContents($link, $refererUrl);

    if ($data['code'] == 200){
      $doc = new DOMDocument();
      $doc->loadHTML($data['data']);
      $xPath = new DOMXpath($doc);

      $data = [];

      // Название
      //<a href="/projects/iphone/need-app-developer-24753302/" class="JobSearchCard-primary-heading-link" data-qtsb-section="page-job-search-new" data-qtsb-subsection="card-job" data-qtsb-label="link-project-title" data-heading-link="true"></a>
      $d1 = parseContent($xPath, "//a[@class='JobSearchCard-primary-heading-link']");
      // Прайс за таск
      // <div class="JobSearchCard-primary-price"></div>
      $d2 = parseContent($xPath, "//div[@class='JobSearchCard-primary-price']",true);
      // Описание
      //<p class="JobSearchCard-primary-description"></p>
      $d3 = parseContent($xPath, "//p[@class='JobSearchCard-primary-description']");
  

      $c = count($d1);
      for($i=0;$i<$c;$i++){
       
        ?><div><strong><?=$d1[$i]?></strong><br><p><?=$d2[$i]?></p><p><?=$d3[$i]?></p></div><?
      }
      
      unset($d1, $d2, $d3);

    } else {
      ?><pre><?=$data['errors']?></pre><?;
    }

    $startPage++;
  }

  echo 'Парсер завершил работу за ' . round(microtime(true) - $start, 1) . ' сек.<br>';

} else {
  die('Что-то пошло не так');
}