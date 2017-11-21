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

    public static function getLocations($locType, $catId = null) {

        // get the db connection
        $db = connectReuseDB();

        // return the query results
        if ($catId === null) {
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
        } else {
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
}
