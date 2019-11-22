/*	These series of commands initializes the equine project database and creates a simple user as the first tuple.
	Project members: Darren Powers, Jake Hayden, Nicholas Poe, and Michael Probst
*/

CREATE DATABASE equine;

USE equine;

CREATE TABLE User(uid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, Name TEXT(15) NOT NULL, Pass TEXT NOT NULL, Clinic TEXT, Role TEXT);

INSERT INTO User VALUES (null, 'Admin', 'admin', 'default-clinic', 'read-write');
INSERT INTO User VALUES (null, 'Reader', 'reader', 'default-clinic', 'read-only');

CREATE TABLE Horse (
        Hid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Hname TEXT NOT NULL, Hdob DATE NOT NULL,
        Hdod DATE,
        Hbreed TEXT NOT NULL,
        Hgender TEXT NOT NULL,
        RaceTraining BOOL,
        RaceExternal BOOL,
        RaceStartAge DATE
        );

INSERT INTO Horse VALUES (NULL, 'horsie', '1999-11-11', NULL, 'mustang', 'filly', NULL, NULL, NULL);

INSERT INTO Horse VALUES (NULL, 'pony', '2019-10-28', NULL, 'thoroughbred', 'mare', NULL, NULL, NULL);

-- PahtologySite table creation and example

CREATE TABLE PathologySite (
        Sid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Limb TEXT,
        Bone TEXT,
        Site TEXT
        );

INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', 'Dorsomedial');

-- Pahtology table creation and example

CREATE TABLE Pathology (
        Pid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Pname TEXT
        );

INSERT INTO Pathology VALUES (NULL, 'Within Normal Limits');

-- PathologyAtSite table creation and example. Consider making foreign key constraing be: ON DELETE SET NULL.

CREATE TABLE PathologyAtSite (
        Pid INT NOT NULL,
        Sid INT NOT NULL,
        Available BOOL,
        PRIMARY KEY(Pid, Sid),

        FOREIGN KEY (Pid)
                REFERENCES Pathology(Pid)
                ON UPDATE CASCADE ON DELETE CASCADE,

        FOREIGN KEY (Sid)
                REFERENCES PathologySite(Sid)
                ON UPDATE CASCADE ON DELETE CASCADE
        );

INSERT INTO PathologyAtSite(Pid, Sid) VALUES (1, 1);
-- i.e., "Within normal limits" is available to "distoal Radius Dorsomedial"

CREATE TABLE Assessment (
        Cid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Chorse INT NOT NULL,
        Cuser INT NOT NULL,
        Cdate DATE NOT NULL,
        UK_Cid TEXT,
        RREH_Cid TEXT NOT NULL,
        Limb TEXT NOT NULL,
        PhantomDensityIncluded BOOL,

        FOREIGN KEY(Chorse)
                REFERENCES Horse(Hid)
                ON UPDATE CASCADE ON DELETE CASCADE,

        FOREIGN KEY(Cuser)
                REFERENCES User(Uid)
                ON UPDATE CASCADE ON DELETE CASCADE);

INSERT INTO Assessment (Cid, Chorse, Cuser, Cdate, RREH_Cid, Limb) VALUES (1, 2, 1, '2019-10-28', 'abc123', 'Foreleg');

-- CasePathology table creation and example

CREATE TABLE CasePathology (
        Cid INT NOT NULL,
        Sid INT NOT NULL,
        Pid INT NOT NULL,

        PRIMARY KEY(Cid, Sid, Pid),

        FOREIGN KEY(Cid)
                REFERENCES PathologyCase(Cid)
                ON UPDATE CASCADE ON DELETE CASCADE,

        FOREIGN KEY(Sid)
                REFERENCES PathologySite(Sid)
                ON UPDATE CASCADE ON DELETE CASCADE,

        FOREIGN KEY(Pid)
                REFERENCES Pathology(Pid)
                ON UPDATE CASCADE ON DELETE CASCADE
        );

INSERT INTO CasePathology (Cid, Sid, Pid) VALUES (1, 1, 1);

/*Create users for database*/
CREATE user 'read-write'@'localhost' identified by 'shakespeare16';
GRANT SELECT, INSERT, UPDATE ON equine.* to 'read-write'@'localhost';
FLUSH privileges;

Create user 'read-only'@'localhost' identified by 'bookworm12';
GRANT SELECT ON equine.* to 'read-only'@'localhost';
FLUSH privileges;
