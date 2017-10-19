var APIBase = ""; //used by the live website

//formats a string of numbers according to conventional styling of phone numbers
function getFormattedPhone(phoneString) {
    var formattedPhone = "";

    if(phoneString.length == 7) {
        formattedPhone = phoneString.substring(0, 3) + "-" + phoneString.substring(3, 7);

    }
    else if (phoneString.length == 10){
        formattedPhone = "(" + phoneString.substring(0, 3) + ") " + phoneString.substring(3, 6) + "-" + phoneString.substring(6, 10);

    }
    else if (phoneString.length == 11){
        formattedPhone = " 1 (" + phoneString.substring(1, 4) + ") " + phoneString.substring(4, 7) + "-" + phoneString.substring(7, 11);
    }

    return formattedPhone;
}

//formats a string of numbers according to conventional styling of zip codes
function getFormattedZip(zipString) {
    var formattedZip = "";

    if(zipString.length == 5) {
        formattedZip = zipString;
    }
    else {
        formattedZip = zipString.substring(0, 5) + "-" + "" + zipString.substring(5, phoneString.length);
    }

    return formattedZip;
}

//replaces a single slash with an underscore - a counterpart to underscoreToSlash in WebsiteRoutes.php
function slashToUnderscore(string) {
    if(string) {
        var string = string.replace("/", "_");
    }

    return string;
}

// Main function for searching a specific term
function searchTerm(search_term) {
    document.getElementsByClassName("side-container-title")[0].innerHTML =
        "Search results containing '" + decodeURI(slashToUnderscore(search_term)) + "'";

    $.ajax({
        type: "GET",
        url: "/item/" + search_term,
        dataType: 'json',
        success: function(res) {
            for (k = 0; k < res.length; k++) {
                var bus_name = res[k].name;

                var listDiv = document.getElementById("category-list-container");
                listDiv.className += " list-group";

                //the link
                var link = document.createElement("a");
                link.className = "list-group-item";
                link.className += " list-item-title";
                link.setAttribute('href', "business.php?name=" + encodeURIComponent(bus_name));

                //the item name
                var busName = document.createElement("p");
                busName.className = "list-group-item-heading";
                busName.appendChild(document.createTextNode(bus_name));
                busName.setAttribute('data-lat', res[k].latitude);
                busName.setAttribute('data-lon', res[k].longitude);
                link.appendChild(busName);

                listDiv.appendChild(link);

                // the address
                if (res[k].address_line_1 && res[k].city && res[k].zip_code) {
                    var linkAddress = document.createElement("p");
                    linkAddress.className = "list-group-item-text";

                    var pinIcon = document.createElement("img");
                    pinIcon.src = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|F89420";
                    pinIcon.className = "pin-icon";
                    linkAddress.appendChild(pinIcon);

                    linkAddress.appendChild(document.createTextNode(res[k].address_line_1));
                    linkAddress.appendChild(document.createElement("br"));


                    var cityAddressNode = document.createElement("p");
                    cityAddressNode.id = "second-line-address";
                    var cityAddress = document.createTextNode(res[k].city + ", " + getFormattedZip(res[k].zip_code));
                    cityAddressNode.appendChild(cityAddress);

                    linkAddress.appendChild(cityAddressNode);

                    link.appendChild(linkAddress);
                }

                //phone
                if(res[k].phone) {
                    var linkPhone = document.createElement("p");
                    linkPhone.className = "list-group-item-text";

                    var phoneIcon = document.createElement("i");
                    phoneIcon.className = "zmdi";
                    phoneIcon.className += " zmdi-phone";

                    linkPhone.appendChild(phoneIcon);
                    linkPhone.appendChild(document.createTextNode(getFormattedPhone(res[k].phone)));

                    link.appendChild(linkPhone);
                }

                //the website
                if(res[k].website) {
                    var linkWebsite = document.createElement("a");
                    linkWebsite.setAttribute('href', res[k].website);
                    linkWebsite.className = "list-group-item-text";

                    var webIcon = document.createElement("i");
                    webIcon.className = "zmdi";
                    webIcon.className += " zmdi-globe";

                    linkWebsite.appendChild(webIcon);
                    linkWebsite.appendChild(document.createTextNode(res[k].website));

                    link.appendChild(linkWebsite);
                }
            }
        }
    });
}