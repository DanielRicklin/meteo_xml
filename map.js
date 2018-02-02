let lat = document.querySelector('#lat').innerHTML;
let lon = document.querySelector('#lon').innerHTML;
//let lat_station = document.querySelectorAll('.lat');
//let lon_station = document.querySelectorAll('.lon');
let mymap = L.map('mapid').setView([lat, lon], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'mapbox.streets'
}).addTo(mymap);

/*for(let i=0;i <= lat_station.length;i++){
    for(let i=0;i <= lon_station.length;i++){
        L.marker([lat_station[i].innerHTML, lon_station[i].innerHTML]).addTo(mymap).bindPopup(lat_station[i].dataset.nom).openPopup();
    }
}*/


L.marker([lat,lon]).addTo(mymap).bindPopup("vous êtes ici").openPopup();


var popup = L.popup();

/*function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Vous êtes ici")
        .openOn(mymap);
}*/

// mymap.on('click', onMapClick);