/*	These series of commands builds and initializes data in the equine project database.
	Project members: Darren Powers, Jake Hayden, Nicholas Poe, and Michael Probst
*/

### CREATE DATABASE equine; -- Create the equine database.  Uncomment this line to use.

USE equine;

-- Create Users Table
CREATE TABLE User(uid INT NOT NULL PRIMARY KEY AUTO_INCREMENT, Name TEXT(15) NOT NULL, Pass TEXT NOT NULL, Clinic TEXT, Role TEXT);

-- Populate Users Table with 'Default Clinic' users.
INSERT INTO User VALUES (NULL, 'Admin', 'admin', 'default-clinic', 'read-write'), 
        (NULL, 'Reader', 'reader', 'default-clinic', 'read-only'),
        (NULL, 'cs405', 'cs405', 'default-clinic', 'read-write');

-- Create Horse Table
CREATE TABLE Horse (
        Hid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Hname TEXT NOT NULL, 
        Hdob DATE NOT NULL,
        Hdod DATE,
        Hbreed TEXT NOT NULL,
        Hgender TEXT NOT NULL,
        UK_Cid TEXT,
        RREH_Cid TEXT NOT NULL,
        RaceTraining BOOL,
        RaceExternal BOOL,
        RaceStartAge INT
        );

-- Create Horse Sample Data.

INSERT INTO Horse VALUES (NULL, 'Horsie', '1999-11-11', NULL, 'arabian', 'intact-male', NULL, '123456789', NULL, NULL, NULL);
INSERT INTO Horse VALUES (NULL, 'Pony', '1999-11-11', NULL, 'thoroughbred', 'female', NULL, '123412341', NULL, NULL, NULL);

-- PathologySite table creation and population. Pathology Site is the physical location being assessed on a form.

CREATE TABLE PathologySite (
        Sid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Limb TEXT,
        Bone TEXT,
        Site TEXT,
	SiteB TEXT
        );

-- Populate Initial PathologySite data

INSERT INTO PathologySite VALUES (NULL, 'Forelimb', 'Distal Radius', NULL, NULL),
        (NULL, 'Forelimb', 'Distal Radius', 'Dorsomedial', NULL),
        (NULL, 'Forelimb', 'Distal Radius', 'Dorsolateral', NULL),
        (NULL, 'Forelimb', 'Distal Radius', 'Palmar', NULL),
        (NULL, 'Forelimb', 'Radiocarpal Bone', NULL, NULL),
        (NULL, 'Forelimb', 'Radiocarpal Bone', 'Proximal Medial', NULL),
        (NULL, 'Forelimb', 'Radiocarpal Bone', 'Proximal Lateral', NULL),
        (NULL, 'Forelimb', 'Radiocarpal Bone', 'Distal Medial', NULL),
        (NULL, 'Forelimb', 'Radiocarpal Bone', 'Distal Lateral', NULL),
        (NULL, 'Forelimb', 'Metacarpal 3', NULL, NULL),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', NULL),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', 'Dorsal'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Proximal', 'Palmar'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', NULL),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', 'Dorsal'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Diaphysis', 'Palmar'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', NULL),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Medial'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Lateral'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Dorsal Saggital Ridge'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Medial'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Lateral'),
        (NULL, 'Forelimb', 'Metacarpal 3', 'Distal', 'Palmar Saggital Ridge'),
        (NULL, 'Forelimb', 'Medial Sesamoid', NULL, NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Apical Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Apical Non-Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Midbody Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Midbody Non-Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Base Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Base Non-Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Axial Articular', NULL),
        (NULL, 'Forelimb', 'Medial Sesamoid', 'Axial Non-Articular', NULL);

INSERT INTO PathologySite 
-- Create Pathology table. Pathologies are the specific options selectable for each Site in an assessment.

CREATE TABLE Pathology (
        Pid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Pname TEXT
        );

-- Populate Pathology table with initial data.

INSERT INTO Pathology VALUES (NULL, 'Not Assessed'),
        (NULL, 'Within Normal Limits'),
        (NULL, 'Cyst-Like Lesion'),
        (NULL, 'Lysis'),
        (NULL, 'Sclerosis'),
        (NULL, 'Osteochondral Fragment'),
        (NULL, 'Fracture'),
        (NULL, 'Osteophyte'),
        (NULL, 'Periosteal Proliferation'),
        (NULL, 'Endosteal Proliferation'),
        (NULL, 'Enthesophyte'),
        (NULL, 'Condylar Fracture'),
        (NULL, 'Diaphyseal Fracture'),
        (NULL, 'Dorsal Cortical Fracture'),
        (NULL, 'Supracondylar Lysis'),
        (NULL, 'Contour Change');


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
INSERT INTO PathologyAtSite VALUES (1, 1), -- Not Assessed
        (1, 2),
        (1, 3),
        (1, 4),
        (1, 5),
        (1, 6),
        (1, 7),
        (1, 8),
        (1, 9),
        (1, 10),
        (1, 11),
        (1, 12),
        (1, 13),
        (1, 14),
        (1, 15),
        (1, 16),
        (1, 17),
        (1, 18),
        (1, 19),
        (1, 20),
        (1, 21),
        (1, 22),
        (1, 23),
        (1, 24),
        (1, 25),
        (1, 26),
        (1, 27),
        (1, 28),
        (1, 29),
        (1, 30),
        (1, 31),
        (1, 32),
        (2, 1), -- Within Normal Limits
        (2, 2),
        (2, 3),
        (2, 4),
        (2, 5),
        (2, 6),
        (2, 7),
        (2, 8),
        (2, 9),
        (2, 10),
        (2, 11),
        (2, 12),
        (2, 13),
        (2, 14),
        (2, 15),
        (2, 16),
        (2, 17),
        (2, 18),
        (2, 19),
        (2, 20),
        (2, 21),
        (2, 22),
        (2, 23),
        (2, 24),
        (2, 25),
        (2, 26),
        (2, 27),
        (2, 28),
        (2, 29),
        (2, 30),
        (2, 31),
        (2, 32),
-- Pathologies by site
        (3, 1), -- Foreleg Distal Radius
        (4, 2), -- Foreleg Distal Radius Dorsomedail
        (5, 2),
        (6, 2),
        (7, 2),
        (4, 3), -- Forelimb Distal Radius Dorsolateral
        (5, 3),
        (6, 3),
        (7, 3),
        (4, 4), -- Forelimb Distal Radius Palmar
        (5, 4),
        (6, 4),
        (7, 4),
        (3, 5), -- Forelimb Radiocarpal Bone
        (4, 6), -- Forelimb Radiocarpal Bone Proximal Medial
        (5, 6),
        (8, 6),
        (6, 6),
        (7, 6),
        (4, 7), -- Forelimb Radiocarpal Bone Proximal Lateral
        (5, 7),
        (8, 7),
        (6, 7),
        (7, 7),
        (4, 8), -- Forelimb Radiocarpal Bone Distal Medial
        (5, 8),
        (8, 8),
        (6, 8),
        (7, 8),
        (4, 9), -- Forelimb Radiocarpal Bone Distal Lateral
        (5, 9),
        (8, 9),
        (6, 9),
        (7, 9),
        (3, 10), -- Forelimb Metacarpal 3
        (3, 11), -- Forelimb Metacarpal 3 Proximal
        (4, 12), -- Forelimb Metacarpal 3 Proximal Dorsal
        (5, 12),
        (9, 12),
        (10, 12),
        (8, 12),
        (11, 12),
        (6, 12),
        (7, 12),
        (4, 13), -- Forelimb Metacarpal 3 Proximal Palmar
        (5, 13),
        (9, 13),
        (10, 13),
        (8, 13),
        (11, 13),
        (6, 13),
        (7, 13),
        (3, 14), -- Forelimb Metacarpal 3 Diaphysis
        (4, 15), -- Forelimb Metacarpal 3 Diaphysis Dorsal
        (5, 15),
        (9, 15),
        (10, 15),
        (12, 15),
        (13, 15),
        (14, 15),
        (4, 16), -- Forelimb Metacarpal 3 Diaphysis Palmar
        (5, 16),
        (9, 16),
        (10, 16),
        (12, 16),
        (13, 16),
        (14, 16),
        (3, 17), -- Forelimb Metacarpal 3 Distal
        (4, 18), -- Forelimb Metacarpal 3 Distal Dorsal Medial
        (5, 18),
        (8, 18),
        (6, 18),
        (7, 18),
        (4, 19), -- Forelimb Metacarpal 3 Distal Dorsal Lateral
        (5, 19),
        (8, 19),
        (6, 19),
        (7, 19),
        (4, 20), -- Forelimb Metacarpal 3 Distal Dorsal Sagittal Ridge
        (5, 20),
        (8, 20),
        (6, 20),
        (7, 20),
        (4, 21), -- Forelimb Metacarpal 3 Distal Palmar Medial
        (5, 21),
        (8, 21),
        (6, 21),
        (7, 21),
        (15, 21),
        (16, 21),
        (4, 22), -- Forelimb Metacarpal 3 Distal Palmar Lateral
        (5, 22),
        (8, 22),
        (6, 22),
        (7, 22),
        (15, 22),
        (16, 22),
        (4, 23), -- Forelimb Metacarpal 3 Distal Palmar Sagittal Ridge
        (5, 23),
        (8, 23),
        (6, 23),
        (7, 23),
        (15, 23),
        (16, 23),
        (3, 24), -- Forelimb Medial Sesamoid
        (4, 25), -- Forelimb Medial Sesamoid Apical Articular
        (5, 25),
        (7, 25),
        (4, 26), -- Forelimb Medial Sesamoid Apical Non-Articular
        (5, 26),
        (7, 26),
        (4, 27), -- Forelimb Medial Sesamoid Midbody Articular
        (5, 27),
        (7, 27),
        (4, 28), -- Forelimb Medial Sesamoid Midbody Non-Articular
        (5, 28),
        (7, 28),
        (4, 29), -- Forelimb Medial Sesamoid Base Articular
        (5, 29),
        (7, 29),
        (4, 30), -- Forelimb Medial Sesamoid Base Non-Articular
        (5, 30),
        (7, 30),
        (4, 31), -- Forelimb Medial Sesamoid Axial Articular
        (5, 31),
        (7, 31),
        (4, 32), -- Forelimb Medial Sesamoid Axial Non-Articular
        (5, 32),
        (7, 32);




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