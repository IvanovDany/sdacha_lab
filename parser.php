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

function curlGetContents($pageUrl, $baseUrl,  $retry = true) {
  $errors = [];
  //Получаем дескриптор cURL;
  $ch = curl_init();
  //Установка параметров для имеющегося сеанса/дескриптора
  curl_setopt($ch, CURLOPT_HEADER, false); // отключить вывод заголовков
  curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false); //для остановки cURL от проверки сертификата узла сети.
  curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); // не проверять существование имени общего имени в сертификате ssl
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер.
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // Содержимое заголовка "User-Agent: ", посылаемого в HTTP-запросе.

  curl_setopt($ch, CURLOPT_URL, $pageUrl); // Загружаемый URL.
  curl_setopt($ch, CURLOPT_REFERER, $baseUrl); // Содержимое заголовка "Referer: ", который будет использован в HTTP-запросе.

  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // для следования любому заголовку "Location: ", отправленному сервером в своем ответе

  $response['data'] = curl_exec($ch);//Выполняет запрос cURL

  $ci = curl_getinfo($ch);//Чекаем инфу ради получения статуса ответа http_code
  
  if($ci['http_code'] != 200 && $ci['http_code'] != 404) {
    $errors[] = [1, $pageUrl, $ci['http_code']];
    //попытка повторного подключения, если статусы не 200 и не 404
    if($retry) {
      sleep(4);
      $response['data'] = curl_exec($ch);
      $ci = curl_getinfo($ch);
      //если ситуация не поменялась, то пишем ошибку
      if($ci['http_code'] != 200 && $ci['http_code'] != 404){
        $errors[] = [2, $pageUrl, $ci['http_code']];
      }
    }
  }

  $response['code'] = $ci['http_code'];
  $response['errors'] = $errors;

  curl_close($ch);//Завершает сеанс cURL

  return $response;
}


function parseContent(DOMXpath $xPath, $query = '//',$is_price=false)
{
  $result = [];
  $q = $xPath->query($query);
  foreach ($q as $k => $item) {
    $textRaw = trim($item->textContent);
    if($is_price){
    $textRaw = trim($textRaw, '(Avg Bid)');
    $result[] = trim($textRaw);
    }
    else
      $result[] = $textRaw;
  }
  return $result;
}
