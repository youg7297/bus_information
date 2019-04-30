<?php
$naf = "";
$tmp = "";

if(isset($_GET['tmp'])){
    $tmp = $_GET['tmp'];
}
if(isset($_GET['naf'])){
    $naf = $_GET['naf'];
}

$ServiceKey = "RGFGRkYlMkZ2Q0dwNFplc0VRcEJQWnloQjU5MXNvNXlma0RvdyUyQkI3MVRKVmhFZ2tWN2VTOTd0a0ZnbXByNXpTeEpJRXFWWXlEdDlMQkRiM0pxb1FsWFh3JTNEJTNE";// 암호화 문자열
$ServiceKey = base64_decode($ServiceKey);

//고유번호검색
if($naf != "" && $tmp == "unique"){
$ch = curl_init();
$url = 'http://ws.bus.go.kr/api/rest/stationinfo/getStationByName'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=' . $ServiceKey; /*Service Key*/
$queryParams .= '&' . urlencode('stSrch') . '=' . urlencode($naf); /*정류소명 검색어*/

curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

// var_dump($response);

$obj = simplexml_load_string($response);
if($obj->msgHeader->headerMsg == "결과가 없습니다."){
    echo "결과가 없습니다";
    return;
}
$total = 0;
$arsIdArr = [];//정류소고유번호
$stNmArr = []; //정류장이름
foreach($obj->msgBody->itemList as $val){
    $arsId = $val->arsId;
    $stNm = $val->stNm;
    $total++;
    // echo $arsId;
    array_push($arsIdArr, $arsId);
    array_push($stNmArr, $stNm);
}
for($i = 0; $i < $total; $i++){
    echo "<p>정류소 고유번호 : <a href='index.php?tmp=arrival&naf=$arsIdArr[$i]'>" . $arsIdArr[$i] ."</a></p>";
    echo "<p>정류소 이름 : " . $stNmArr[$i] ."</p>";
    echo "<div class='line'></div>";
}

}
//버스정보검색
if($naf != "" && $tmp == "arrival"){
    $ch = curl_init();
    $url = 'http://ws.bus.go.kr/api/rest/stationinfo/getStationByUid'; /*URL*/
    $queryParams = '?' . urlencode('ServiceKey') . '=DaFFF%2FvCGp4ZesEQpBPZyhB591so5yfkDow%2BB71TJVhEgkV7eS97tkFgmpr5zSxJIEqVYyDt9LBDb3JqoQlXXw%3D%3D'; /*Service Key*/
    $queryParams .= '&' . urlencode('arsId') . '=' . urlencode($naf); /**/
    curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $response = curl_exec($ch);
    curl_close($ch);
    
    // var_dump($response);

    $obj = simplexml_load_string($response);
    if($obj->msgHeader->headerMsg == "결과가 없습니다."){
        echo "결과가 없습니다";
        return;
    }
    $total = 0;

    $arrmsg1Arr = []; //첫번째 예정버스
    $arrmsg2Arr = []; //두번쨰 예정버스

    $gpsX = ""; //x좌표
    $gpsY = ""; //y좌표
    $stNm; //정류장 이름
    $rtNmArr = []; //버스 번호
    $routeTypeArr = [];
    foreach($obj->msgBody->itemList as $val){
        $arrmsg1 = $val->arrmsg1;
        $arrmsg2 = $val->arrmsg2;
        $gpsX = $val->gpsX;
        $gpsY = $val->gpsY;
        $stNm = $val->stNm;
        $rtNm = $val->rtNm;
        $routeType = $val->routeType;
        $total++;
        // echo $arsId;
        array_push($arrmsg1Arr, $arrmsg1);
        array_push($arrmsg2Arr, $arrmsg2);
        array_push($rtNmArr, $rtNm);
        array_push($routeTypeArr, $routeType);
    }
    
    echo "<p class='stNm'>" . $stNm ."</p>";
    for($i = 0; $i < $total; $i++){
        echo "<div class='bus_box'>";
        if ($routeTypeArr[$i] == 3){
            echo '<div class="bus"><img src="img/blue_bus.png" alt="blue_bus"></div>';
        } else if($routeTypeArr[$i] == 4 || $routeTypeArr[$i] == 2) {
            echo '<div class="bus"><img src="img/green_bus.png" alt="green_bus"></div>';
        } else {
            echo '<div class="bus"><img src="img/red_bus.png" alt="red_bus"></div>';
        }
        echo "<p class='rtNm'>" . $rtNmArr[$i] . "</p>";
        echo "<p class='arrmsg1'>도착 예정 시간 : " . $arrmsg1Arr[$i] ."</p>";
        echo "<p class='arrmsg2'>도착 예정 시간 : " . $arrmsg2Arr[$i] ."</p>";
        echo "<p class='routeType'>노선 유형 : " . $routeTypeArr[$i] . "</p>";
        echo "</div>";
    }
    echo "<p class='gpsX'>".$gpsX."</p>";
    echo "<p class='gpsY'>".$gpsY."</p>";
    
}
?>


<script>
console.log("DaFFF%2FvCGp4ZesEQpBPZyhB591so5yfkDow%2BB71TJVhEgkV7eS97tkFgmpr5zSxJIEqVYyDt9LBDb3JqoQlXXw%3D%3D");
    </script>