/*Create users for php calls to mysql database. Uncomment lines to use.*/
CREATE user 'read-write'@'localhost' identified by 'shakespeare16';
GRANT SELECT, INSERT, UPDATE ON equine.* to 'read-write'@'localhost';
FLUSH privileges;

Create user 'read-only'@'localhost' identified by 'bookworm12';
GRANT SELECT ON equine.* to 'read-only'@'localhost';
FLUSH privileges;
