<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://api.longdo.com/map/?key=a67fa870ebf4ee3ab9285e0ac30cf3cc"></script>
    <!-- <script src="{path_to_longdo_map}/longdomap.js"></script> -->
    <title>Home</title>
    <style type="text/css">
        html {
            height: 100%;
        }

        body {
            margin: 0px;
            height: 100%;
        }

        #map {

            height: 100%;
        }
        
    </style>
</head>

<body onload="initMap();">
    <div class="text-center">
        
            
      
        <div class="row justify-content-center mt-3">
            <div class="" id="gimage" ></div>
            <h1 id="Name"></h1>
        </div>
        <div class="row justify-content-center mt-3">
            <h1 id="Name"></h1>
        </div>
        <div class="row justify-content-center">
            <p id="details"></p>
        </div>
    </div>
    <div id="map"></div>
    <div id="result"></div>
</body>

</html>
<script>
    const url_params = new URLSearchParams(window.location.search)
    const id = url_params.get('id')
    console.log(id);
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    fetch("http://localhost/ProjectCIT3514/api/readone.php?id=" + id, requestOptions)
        .then(response => response.text())
        .then(result => {
            var jsonget = JSON.parse(result)
            document.getElementById('Name').innerHTML = jsonget.Name
            document.getElementById('details').innerHTML = jsonget.details
            // document.getElementById('photo').innerHTML = jsonget.photo

        })
        .catch(error => console.log('error', error));

    function initMap(address, destinationLat, destinationLng) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', "http://localhost/ProjectCIT3514/api/readone.php?id=" + id);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const arraydata = Object.values(data);
                // console.log(arraydata);
                map = new longdo.Map({
                    placeholder: document.getElementById('map')
                });
                map.Route.placeholder(document.getElementById('result'));
                // const geo = map.location(longdo.LocationMode.Geolocation);
                map.Route.add(new longdo.Marker({
                    lon: 99.844388,
                    lat: 19.985479
                }, {
                    title: 'Victory monument',
                    detail: 'I\'m here'
                }));
                map.Route.add({
                    lon: parseFloat(arraydata[6]),
                    lat: parseFloat(arraydata[5])
                });
                map.Route.search();
            }
        }
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send();
    };

    function gellryewat() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "http://localhost/ProjectCIT3514/api/readone.php?id=" + id)
        xhttp.send()
        // console.log("http://localhost/ProjectCIT3514/api/readone.php?id=" + id)
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText)
                var trHTML = ''
                // console.log(this.responseText);
                const objects = JSON.parse(this.responseText)
                const object = objects['photo'];
                // console.log("object : " + object)
                // console.log("objects : " + objects);
                // console.log("objects + photo : " + objects['photo']);
                // if (Array.isArray(dat)) {
                //     for (let object of dat) {

                trHTML += '<div class="col-12 col-md-4 col-lg-4 my-2 ">';
                trHTML += '<div class="card">';
                trHTML += '<img src="' + object + '"  class="card-img-top" alt="" width="100%" height="100%">';
                trHTML += '</div>';
                trHTML += '</div>';
                //     }
                // }
                document.getElementById("gimage").innerHTML = trHTML;

            }
        }
    }
    gellryewat();
</script>