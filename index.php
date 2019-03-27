<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BUS INFO</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDS0-Z9U2QNT5Hs7wv4LJWmHLhYgIGlxg&callback=initMap"async defer></script>
</head>
<body>
    <div class="wrap">
        <header>
            <div class="logo">
                <h1>BUS INFO</h1>
                <img src="img\bus-stop.png" alt="logo">
            </div>
            <div class="search">
                <form action="index.php" type="get">
                    <select name="tmp" id="tmp"> 
                        <option value="unique">정류장 이름으로 고유번호 검색</option>
                        <option value="arrival">고유번호로 버스 도착정보 검색</option> 
                    </select> 
                    <input type="text" name="naf" id="naf" placeholder="검색어 입력">
                    <input type="submit" id="search" value="검색">
                </form>
            </div>
        </header>
        <section>
            <article class="main">
                <div id="map"></div>
            </article>
            <aside class="search-info" id="info">
                <?php include("info.php");?>
            </aside>
        </section>
    </div>
    <script src="javascript/map.js"></script>
</body>
</html>