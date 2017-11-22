<?php

/*
 * TODO: Write better documentation
 * The purpose of this class is to collect all queries used across the codebase into one class.
 * If it get too large, of course, we'll have to split it up into smaller chunks more related to
 * the type of query but for now this can serve as a query warehouse.
 */

class Query {

    public static function getAllUniqueDonors() {

        $db = connectReuseDB();
        return $db->query("SELECT DISTINCT * FROM Reuse_Donors ORDER BY name;");
    }

    public static function getLocations($locType, $args = []) {

        // TODO: this does not work for Recycle locations because no recycle location is related to another item.
        // to recycle is just a designation on a location, despite the fact that the Resource_Type table has a field
        // call "recycle"

        // tack on default values and extract variables
        $args += [
            'catId' => null,
            'itemId' => null
        ];
        extract($args);

        // get the db connection
        $db = connectReuseDB();

        /*
            NOTE: If you're using and IDE, you might get errors / hinding indicating catId and itemId are invalid
            but they get extracted out of $args.  This is the only way, currently, in PHP to do named arguments.
        */

        // return the query results
        if ($catId === null && $itemId === null) {
            return $db->query(
                "SELECT DISTINCT loc.name, loc.id, loc.address_line_1, loc.address_line_2, state.abbreviation,
                    loc.phone, loc.website, loc.city, loc.zip_code, loc.latitude, loc.longitude
                 FROM Reuse_Locations AS loc
                 LEFT JOIN States AS state ON state.id = loc.state_id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON loc.id = loc_item.location_id
                 INNER JOIN Reuse_Items AS item ON loc_item.item_id = item.id
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 WHERE loc_item.Type = $locType
                 ORDER BY loc.name;"
            );
        } else if ($itemId === null) {
            return $db->query(
                "SELECT DISTINCT loc.name, loc.id, loc.address_line_1, loc.address_line_2, state.abbreviation,
                    loc.phone, loc.website, loc.city, loc.zip_code, loc.latitude, loc.longitude
                 FROM Reuse_Locations AS loc
                 LEFT JOIN States AS state ON state.id = loc.state_id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON loc.id = loc_item.location_id
                 INNER JOIN Reuse_Items AS item ON loc_item.item_id = item.id
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 WHERE cat.id = $catId AND loc_item.Type = $locType
                 ORDER BY loc.name"
            );
        } else if ($catId === null) {
            return $db->query(
                "SELECT DISTINCT loc.name, loc.id, loc.address_line_1, loc.address_line_2, state.abbreviation,
                    loc.phone, loc.website, loc.city, loc.zip_code, loc.latitude, loc.longitude
                 FROM Reuse_Locations AS loc
                 LEFT JOIN States AS state ON state.id = loc.state_id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON loc.id = loc_item.location_id
                 INNER JOIN Reuse_Items AS item ON loc_item.item_id = item.id
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 WHERE item.id = $itemId AND loc_item.Type = $locType
                 ORDER BY loc.name"
            );
        } else {
            return $db->query(
                "SELECT DISTINCT loc.name, loc.id, loc.address_line_1, loc.address_line_2, state.abbreviation,
                    loc.phone, loc.website, loc.city, loc.zip_code, loc.latitude, loc.longitude
                 FROM Reuse_Locations AS loc
                 LEFT JOIN States AS state ON state.id = loc.state_id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON loc.id = loc_item.location_id
                 INNER JOIN Reuse_Items AS item ON loc_item.item_id = item.id
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 WHERE cat.id = $catId AND item.id = $itemId AND loc_item.Type = $locType
                 ORDER BY loc.name"
            );
        }
    }

    public static function getRecycleExclusiveLocations() {
        $db = connectReuseDB();
        return $db->query(
            "SELECT DISTINCT loc.name, loc.id, loc.address_line_1, loc.address_line_2, state.abbreviation,
                          loc.phone, loc.website, loc.city, loc.zip_code, loc.latitude, loc.longitude
             FROM Reuse_Locations AS loc
             LEFT JOIN States AS state ON state.id = loc.state_id
             WHERE loc.recycle = 1;"
        );
    }

    public static function getRepairExclusiveCategories() {
        $db = connectReuseDB();
        return $db->query(
            "SELECT DISTINCT c.name, c.id
             FROM Reuse_Locations_Items l
             JOIN Reuse_Items i ON l.item_id = i.id
             JOIN Reuse_Categories c ON i.category_id = c.id
             WHERE l.Type = 1
             ORDER BY c.name ASC"
        );
    }

    public static function getReuseExclusiveCategories() {
        $db = connectReuseDB();
        return $db->query(
            "SELECT DISTINCT c.name, c.id
             FROM Reuse_Locations_Items l
             JOIN Reuse_Items i ON l.item_id = i.id
             JOIN Reuse_Categories c ON i.category_id = c.id
             WHERE l.Type = 0
             ORDER BY c.name ASC"
        );
    }

    public static function getItemsCounts($itemtype, $catId = null) {
        $db = connectReuseDB();
        if ($catId === null) {
            return $db->query(
                "SELECT DISTINCT item.name AS item_name, item.id AS item_id,
                    cat.name AS cat_name, cat.id AS cat_id,
                    COUNT(loc_item.location_id) AS item_count
                 FROM Reuse_Items AS item
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON item.id = loc_item.item_id
                 WHERE loc_item.Type = $itemtype
                 GROUP BY item.name, item.id, cat.name, cat.id
                 ORDER BY item.name;"
            );
        } else {
            return $db->query(
                "SELECT DISTINCT item.name AS item_name, item.id AS item_id,
                    cat.name AS cat_name, cat.id as cat_id,
                    COUNT(loc_item.location_id) AS item_count
                 FROM Reuse_Items AS item
                 INNER JOIN Reuse_Categories AS cat ON item.category_id = cat.id
                 INNER JOIN Reuse_Locations_Items AS loc_item ON item.id = loc_item.item_id
                 WHERE cat.id = $catId AND loc_item.Type = $itemtype
                 GROUP BY item.name, item.id, cat.id
                 ORDER BY item.name"
            );
        }
    }

    public static function getTypeNameById($typeId) {
        return connectReuseDB()->query(
            "SELECT name FROM Resource_Type WHERE id = $typeId"
        );
    }

    public static function getItemNameById($itemId) {
        return connectReuseDB()->query(
            "SELECT name FROM Reuse_Items WHERE id = $itemId"
        );
    }

    public static function getLocationById($id) {
        return connectReuseDB()->query(
            "SELECT loc.name, loc.id, address_line_1, address_line_2, abbreviation, phone, website, city, zip_code, latitude, longitude
             FROM Reuse_Locations AS loc
             LEFT JOIN States ON States.id = loc.state_id
             WHERE loc.id = $id;"
        );
    }

    public static function getItemsForLocationByType($locId, $typeId) {
        return connectReuseDB()->query(
            "SELECT
               item.name     AS item_name,
               category.name AS cat_name
             FROM Reuse_Locations_Items AS loc_items
               INNER JOIN Reuse_Items AS item ON item.id = loc_items.item_id
               INNER JOIN Reuse_Categories AS category ON category.id = item.category_id
               INNER JOIN Resource_Type AS type ON type.id = loc_items.Type
             WHERE loc_items.location_id = $locId AND type.id = $typeId
             ORDER BY item.name;"
        );
    }

    public static function getAllItemsForLocation($locId) {
        return [
            'reuse' => Query::getItemsForLocationByType($locId, 0)->fetch_all(MYSQLI_ASSOC),
            'repair' => Query::getItemsForLocationByType($locId, 1)->fetch_all(MYSQLI_ASSOC),
            'recycle' => Query::getItemsForLocationByType($locId, 2)->fetch_all(MYSQLI_ASSOC)
        ];
    }

    public static function searchForLocationsByTerm($searchTerm) {
        return connectReuseDB()->query(
            "SELECT DISTINCT
               loc.id,
               loc.name,
               loc.address_line_1,
               loc.address_line_2,
               loc.city,
               States.abbreviation,
               loc.zip_code,
               loc.phone,
               loc.website,
               loc.latitude,
               loc.longitude
             FROM Reuse_Locations loc
               INNER JOIN Reuse_Locations_Items rla ON loc.id = rla.location_id
               INNER JOIN Reuse_Items item ON rla.item_id = item.id
               INNER JOIN Reuse_Categories cat ON item.category_id = cat.id
               LEFT JOIN States ON States.id = loc.state_id
             WHERE
             (item.name LIKE '%$searchTerm%') OR
               (loc.name LIKE '%$searchTerm%') OR
               (cat.name LIKE '%$searchTerm%')
             ORDER BY loc.name ASC;"
        );
    }
}
