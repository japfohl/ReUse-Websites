-- // add state foregin key to locations
-- Migration SQL that makes the change goes here.
ALTER TABLE Reuse_Locations DROP KEY `state_id`;
ALTER TABLE Reuse_Locations ADD CONSTRAINT `fk_state_id` FOREIGN KEY (`state_id`) REFERENCES States(`id`);
-- @UNDO
-- SQL to undo the change goes here.
ALTER TABLE Reuse_Locations DROP FOREIGN KEY `fk_state_id`;
ALTER TABLE Reuse_Locations ADD KEY `state_id` (`state_id`);
