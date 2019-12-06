/*Create users for php calls to mysql database. Uncomment lines to use.*/
USE equine;

CREATE user [IF NOT EXISTS] 'read-write'@'localhost' identified by 'shakespeare16';
GRANT SELECT, INSERT, UPDATE ON equine.* to 'read-write'@'localhost';
FLUSH PRIVILEGES;

CREATE user [IF NOT EXISTS] 'read-only'@'localhost' identified by 'bookworm12';
GRANT SELECT ON equine.* to 'read-only'@'localhost';
FLUSH PRIVILEGES;

CREATE user [IF NOT EXISTS] 'cs405'@'localhost' identified by 'cs405';
GRANT ALL PRIVILEGES ON equine.* to 'cs405'@'localhost';
FLUSH PRIVILEGES;