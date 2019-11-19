INSERT INTO PathologyCase (Chorse, Cuser, Cdate, UK_Cid, RREH_Cid, Limb, PhantomDensityIncluded)
VALUES (
        (SELECT Hid
        FROM Horse
        WHERE Horse.Hname = 'horsie'), 1, '1997-11-06', '100', '100', 'Foreleg', true);
