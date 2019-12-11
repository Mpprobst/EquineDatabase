-- SRC Summary Statistics (1, bullet 1)
SELECT Hbreed, Hgender, RaceTraining, COUNT(*) FROM Horse GROUP BY Hbreed, Hgender, RaceTraining;
SELECT Hbreed, Hgender, RaceExternal, COUNT(*) FROM Horse GROUP BY Hbreed, Hgender, RaceExternal;
SELECT Hbreed, Hgender, RaceStartAge, COUNT(*) FROM Horse GROUP BY Hbreed, Hgender, RaceStartAge;

-- QA Pathology Statistics (1, bullets 2 & 3)

SELECT Horse.Hbreed, Horse.Hgender, Assessment.Limb, Assessment.Side, Assessment.PhantomDensityIncluded, COUNT(DISTINCT Horse.Hid) FROM Horse INNER JOIN Assessment ON Horse.Hid = Assessment.Chorse GROUP BY Horse.Hbreed, Horse.Hgender, Assessment.Limb, Assessment.Side, Assessment.PhantomDensityIncluded;

-- QA Pathology Statistics (By Bone) (1, bullets 4 & 5)

SELECT Horse.Hbreed, 
    Horse.Hgender, 
    A.Limb, 
    A.Side, 
    A.Bone,
    A.PhantomDensityIncluded, 
    COUNT(DISTINCT Horse.Hid) 
FROM    (
            SELECT Limb, Side, Bone, Cid, Chorse, PhantomDensityIncluded
            FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite
        ) AS A 
        INNER JOIN Horse ON A.Chorse = Horse.Hid
GROUP BY Horse.Hbreed, Horse.Hgender, A.Limb, A.Side, A.Bone, A.PhantomDensityIncluded;


-- Pathology Designation By Bone by Breed (Numbers 2 and 3)
SELECT  
    A.Limb, 
    A.Side, 
    A.Bone,
    A.Pname, 
    COUNT(DISTINCT Horse.Hid) 
FROM    (
            SELECT Limb, Side, Bone, Pname, Cid, Chorse, Pid
            FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology
        ) AS A 
    INNER JOIN Horse ON A.Chorse = Horse.Hid
WHERE Horse.Hbreed = --CONDITION TO BE PROVIDED IN PHP
     AND A.Pid > 2
GROUP BY A.Limb, A.Side, A.Bone, A.Pname;

-- Pathology Designation by Bone (Number 4)
SELECT
    Limb,
    Side,
    Bone,
    Pname,
    COUNT(DISTINCT Chorse)
FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology
WHERE Bone = --CONDITION TO BE PROVIDED IN PHP
GROUP BY Limb, Side, Bone, Pname;

-- Pathology By SRC Parameter
SELECT  
    A.Limb, 
    A.Side, 
    A.Bone,
    A.Pname, 
    COUNT(DISTINCT Horse.Hid) 
FROM    (
            SELECT Limb, Side, Bone, Pname, Cid, Chorse, Pid
            FROM CasePathology NATURAL JOIN Assessment NATURAL JOIN PathologySite NATURAL JOIN Pathology
        ) AS A 
    INNER JOIN Horse ON A.Chorse = Horse.Hid
WHERE --CONDITION TO BE PROVIDED IN PHP
     AND A.Pid > 2
GROUP BY A.Limb, A.Side, A.Bone, A.Pname;