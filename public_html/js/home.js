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

    // add data to the map
    for (i = 0; i < mapJson.length; i++) {
        // set the pin color based on the type of location
        var pinColor;
        if (mapJson[i].type === "recycle") {
            pinColor = "7C903A"
        } else if (mapJson[i].type === "repair") {
            pinColor = "47A6B2";
        } else {
            pinColor = "F89420";
        }

        // create the pins and data for the marker
        var pinImage = pin(pinColor);
        var latLong = LatLng(mapJson[i].lat, mapJson[i].long);
        var myMarker = marker(
            latLong, indexMap, pinImage, mapJson[i].name, mapJson[i].add,
            mapJson[i].city, mapJson[i].state, mapJson[i].zip
        );

        // add it to the map
        addInfoWindow(myMarker, indexMap);
    }
}