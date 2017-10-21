function initIndexMap() {
    // get the node and the json data attribute
    var map = document.querySelector('#map');
    var mapJson = JSON.parse(map.dataset.maplocs);

    // remove duplicates if there are any
    mapJson = mapJson.sort(function(a, b) { return a.id - b.id }).filter(function(item, pos, arr) {
        return (!pos || item.id !== arr[pos - 1].id)
            & (item.lat !== null & item.long !== null)
            & (item.lat !== "0.00000000" && item.long !== "0.00000000");
    });

    // create the new map
    var indexMap = corvallisMap();

    // object to map pin colors to location type
    var pincolors = {
        "recycle": "7C903A",
        "repair": "47A6B2",
        "reuse": "F89420"
    };

    // add data to the map
    for (i = 0; i < mapJson.length; i++) {
        // create the pins and data for the marker
        var pinImage = pin(pincolors[mapJson[i].type]);
        var latLong = LatLng(mapJson[i].lat, mapJson[i].long);
        var myMarker = marker(
            latLong, indexMap, pinImage, mapJson[i].name, mapJson[i].add,
            mapJson[i].city, mapJson[i].state, mapJson[i].zip
        );

        // add it to the map
        addInfoWindow(myMarker, indexMap);
    }
}
