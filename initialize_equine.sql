/*	These series of commands builds and initializes data in the equine project database.
	Project members: Darren Powers, Jake Hayden, Nicholas Poe, and Michael Probst
*/

### CREATE DATABASE equine; -- Create the equine database.  Uncomment this line to use.

USE equine;

-- Create Users Table
CREATE TABLE User(uid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, Name TEXT(15) NOT NULL, Pass TEXT NOT NULL, Clinic TEXT, Role TEXT);

-- Populate Users Table with 'Default Clinic' users.
INSERT INTO User VALUES (null, 'Admin', 'admin', 'default-clinic', 'read-write');
INSERT INTO User VALUES (null, 'Reader', 'reader', 'default-clinic', 'read-only');
INSERT INTO User Values (NULL, 'cs405', 'cs405', 'default-clinic', 'read-write');

-- Create Horse Table
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

-- Create Horse Sample Data. Uncomment the lines to use.

# INSERT INTO Horse VALUES (NULL, 'horsie', '1999-11-11', NULL, 'mustang', 'filly', NULL, NULL, NULL);
# INSERT INTO Horse VALUES (NULL, 'pony', '2019-10-28', NULL, 'thoroughbred', 'mare', NULL, NULL, NULL);

-- PathologySite table creation and population. Pathology Site is the physical location being assessed on a form.

CREATE TABLE PathologySite (
        Sid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Limb TEXT,
        Bone TEXT,
        Site TEXT,
	SiteB TEXT
        );

-- Populate Initial PathologySite data

INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', NULL, NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', 'Dorsomedial', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', 'Dorsolateral', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', 'Palmar', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Radiocarpal Bone', NULL, NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Radiocarpal Bone', 'Proximal Medial', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Radiocarpal Bone', 'Proximal Lateral', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Radiocarpal Bone', 'Distal Medial', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Radiocarpal Bone', 'Distal Lateral', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', NULL, NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', 'Dorsal');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', 'Palmar');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', 'Dorsal');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', 'Palmar');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Medial');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Lateral');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Saggital Ridge');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Medial');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Lateral');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Saggital Ridge');
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', NULL, NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Apical Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Apical Non-Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Midbody Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Midbody Non-Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Base Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Base Non-Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Axial Articular', NULL);
INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Medial Sesamoid', 'Axial Non-Articular', NULL);

-- Create Pathology table. Pathologies are the specific options selectable for each Site in an assessment.

CREATE TABLE Pathology (
        Pid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Pname TEXT
        );

-- Populate Pathology table with initial data.

INSERT INTO Pathology VALUES (NULL, 'Not Assessed');	
INSERT INTO Pathology VALUES (NULL, 'Within Normal Limits');
INSERT INTO Pathology VALUES (NULL, 'Cyst-Like Lesion');
INSERT INTO Pathology VALUES (NULL, 'Lysis');
INSERT INTO Pathology VALUES (NULL, 'Sclerosis');
INSERT INTO Pathology VALUES (NULL, 'Osteochondral Fragment');
INSERT INTO Pathology VALUES (NULL, 'Fracture');
INSERT INTO Pathology VALUES (NULL, 'Osteophyte');
INSERT INTO Pathology VALUES (NULL, 'Periosteal Proliferation');
INSERT INTO Pathology VALUES (NULL, 'Endosteal Proliferation');
INSERT INTO Pathology VALUES (NULL, 'Enthesophyte');
INSERT INTO Pathology VALUES (NULL, 'Condylar Fracture');
INSERT INTO Pathology VALUES (NULL, 'Diaphyseal Fracture');
INSERT INTO Pathology VALUES (NULL, 'Dorsal Cortical Fracture');
INSERT INTO Pathology VALUES (NULL, 'Supracondylar Lysis');
INSERT INTO Pathology VALUES (NULL, 'Contour Change');


-- Create PathologyAtSite Table. This table holds records connecting a site to the pathologies available to the site.

CREATE TABLE PathologyAtSite (
        Pid INT NOT NULL,
        Sid INT NOT NULL,
        PRIMARY KEY(Pid, Sid),

        FOREIGN KEY (Pid)
                REFERENCES Pathology(Pid)
                ON UPDATE CASCADE ON DELETE CASCADE,

        FOREIGN KEY (Sid)
                REFERENCES PathologySite(Sid)
                ON UPDATE CASCADE ON DELETE CASCADE
        );

-- Populate initial data for the available pathologies for each site.

-- Values for all sites
INSERT INTO PathologyAtSite VALUES (1, 1); -- Not Assessed
INSERT INTO PathologyAtSite VALUES (1, 2);
INSERT INTO PathologyAtSite VALUES (1, 3);
INSERT INTO PathologyAtSite VALUES (1, 4);
INSERT INTO PathologyAtSite VALUES (1, 5);
INSERT INTO PathologyAtSite VALUES (1, 6);
INSERT INTO PathologyAtSite VALUES (1, 7);
INSERT INTO PathologyAtSite VALUES (1, 8);
INSERT INTO PathologyAtSite VALUES (1, 9);
INSERT INTO PathologyAtSite VALUES (1, 10);
INSERT INTO PathologyAtSite VALUES (1, 11);
INSERT INTO PathologyAtSite VALUES (1, 12);
INSERT INTO PathologyAtSite VALUES (1, 13);
INSERT INTO PathologyAtSite VALUES (1, 14);
INSERT INTO PathologyAtSite VALUES (1, 15);
INSERT INTO PathologyAtSite VALUES (1, 16);
INSERT INTO PathologyAtSite VALUES (1, 17);
INSERT INTO PathologyAtSite VALUES (1, 18);
INSERT INTO PathologyAtSite VALUES (1, 19);
INSERT INTO PathologyAtSite VALUES (1, 20);
INSERT INTO PathologyAtSite VALUES (1, 21);
INSERT INTO PathologyAtSite VALUES (1, 22);
INSERT INTO PathologyAtSite VALUES (1, 23);
INSERT INTO PathologyAtSite VALUES (1, 24);
INSERT INTO PathologyAtSite VALUES (1, 25);
INSERT INTO PathologyAtSite VALUES (1, 26);
INSERT INTO PathologyAtSite VALUES (1, 27);
INSERT INTO PathologyAtSite VALUES (1, 28);
INSERT INTO PathologyAtSite VALUES (1, 29);
INSERT INTO PathologyAtSite VALUES (1, 30);
INSERT INTO PathologyAtSite VALUES (1, 31);
INSERT INTO PathologyAtSite VALUES (1, 32);
INSERT INTO PathologyAtSite VALUES (2, 1); -- Within Normal Limits
INSERT INTO PathologyAtSite VALUES (2, 2);
INSERT INTO PathologyAtSite VALUES (2, 3);
INSERT INTO PathologyAtSite VALUES (2, 4);
INSERT INTO PathologyAtSite VALUES (2, 5);
INSERT INTO PathologyAtSite VALUES (2, 6);
INSERT INTO PathologyAtSite VALUES (2, 7);
INSERT INTO PathologyAtSite VALUES (2, 8);
INSERT INTO PathologyAtSite VALUES (2, 9);
INSERT INTO PathologyAtSite VALUES (2, 10);
INSERT INTO PathologyAtSite VALUES (2, 11);
INSERT INTO PathologyAtSite VALUES (2, 12);
INSERT INTO PathologyAtSite VALUES (2, 13);
INSERT INTO PathologyAtSite VALUES (2, 14);
INSERT INTO PathologyAtSite VALUES (2, 15);
INSERT INTO PathologyAtSite VALUES (2, 16);
INSERT INTO PathologyAtSite VALUES (2, 17);
INSERT INTO PathologyAtSite VALUES (2, 18);
INSERT INTO PathologyAtSite VALUES (2, 19);
INSERT INTO PathologyAtSite VALUES (2, 20);
INSERT INTO PathologyAtSite VALUES (2, 21);
INSERT INTO PathologyAtSite VALUES (2, 22);
INSERT INTO PathologyAtSite VALUES (2, 23);
INSERT INTO PathologyAtSite VALUES (2, 24);
INSERT INTO PathologyAtSite VALUES (2, 25);
INSERT INTO PathologyAtSite VALUES (2, 26);
INSERT INTO PathologyAtSite VALUES (2, 27);
INSERT INTO PathologyAtSite VALUES (2, 28);
INSERT INTO PathologyAtSite VALUES (2, 29);
INSERT INTO PathologyAtSite VALUES (2, 30);
INSERT INTO PathologyAtSite VALUES (2, 31);
INSERT INTO PathologyAtSite VALUES (2, 32);
-- Pathologies by site
INSERT INTO PathologyAtSite VALUES (3, 1); -- Foreleg Distal Radius
INSERT INTO PathologyAtSite VALUES (4, 2); -- Foreleg Distal Radius Dorsomedail
INSERT INTO PathologyAtSite VALUES (5, 2);
INSERT INTO PathologyAtSite VALUES (6, 2);
INSERT INTO PathologyAtSite VALUES (7, 2);
INSERT INTO PathologyAtSite VALUES (4, 3); -- Forelimb Distal Radius Dorsolateral
INSERT INTO PathologyAtSite VALUES (5, 3);
INSERT INTO PathologyAtSite VALUES (6, 3);
INSERT INTO PathologyAtSite VALUES (7, 3);
INSERT INTO PathologyAtSite VALUES (4, 4); -- Forelimb Distal Radius Palmar
INSERT INTO PathologyAtSite VALUES (5, 4);
INSERT INTO PathologyAtSite VALUES (6, 4);
INSERT INTO PathologyAtSite VALUES (7, 4);
INSERT INTO PathologyAtSite VALUES (3, 5); -- Forelimb Radiocarpal Bone
INSERT INTO PathologyAtSite VALUES (4, 6); -- Forelimb Radiocarpal Bone Proximal Medial

-- Create Assessment Table. This is the root element for the forms containing basic data and an identifier used for the CasePathology table.

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

-- We can generate sample data here.

-- Create CasePathology table. This table holds the specific pathology selectiosn for each site tied to a specific assessment (case)

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

-- We can generate sample data here.

/*Create users for php calls to mysql database. Uncomment lines to use.*/
# CREATE user 'read-write'@'localhost' identified by 'shakespeare16';
# GRANT SELECT, INSERT, UPDATE ON equine.* to 'read-write'@'localhost';
# FLUSH privileges;

# Create user 'read-only'@'localhost' identified by 'bookworm12';
# GRANT SELECT ON equine.* to 'read-only'@'localhost';
# FLUSH privileges;
