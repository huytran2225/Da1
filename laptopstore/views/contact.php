<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laptoptech tore - Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="views/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="views/assets/img/favicon.ico">

    <link rel="stylesheet" href="views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/assets/css/templatemo.css">
    <link rel="stylesheet" href="views/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="views/assets/css/fontawesome.min.css">

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    
    <!-- Close Top Nav -->

    <?php

include("header.php");
?>
  

    


    <!-- Start Content Page -->
    <div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Liện hệ với chúng tôi</h1>
            <p>
                SĐT:
                <br>
                Địa chỉ:
            </p>
        </div>
    </div>

    <!-- Start Map -->
<div id="mapid" style="width: 100%; height: 300px;"></div>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
    var mymap = L.map('mapid').setView([10.7769, 106.7009], 13); // Tọa độ TP.HCM

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Thiết kế bởi <a href="https://templatemo.com/">Templatemo</a> | Dữ liệu bản đồ &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Hình ảnh © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    L.marker([10.7769, 106.7009]).addTo(mymap)
        .bindPopup("<b>Cửa hàng Zay</b><br />Địa chỉ: TP. Hồ Chí Minh.").openPopup();

    mymap.scrollWheelZoom.disable();
    mymap.touchZoom.disable();
</script>
<!-- End Map -->


   
    <?php

include("footer.php");
?>
    

    <!-- Start Script -->
    <script src="views/assets/js/jquery-1.11.0.min.js"></script>
    <script src="views/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="views/assets/js/bootstrap.bundle.min.js"></script>
    <script src="views/assets/js/templatemo.js"></script>
    <script src="views/assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>