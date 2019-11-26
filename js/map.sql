SELECT COUNT(branchId), districtName FROM branch_master WHERE branchId < 100000 GROUP BY districtName

SELECT * FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200002) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000

SELECT
(SELECT COUNT(*)  FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001)  AND bm.branchId < 10000 GROUP BY bm.districtName) AS Total, 
(SELECT COUNT(*)  FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName) AS Downloads,
(SELECT COUNT(*)  FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName) AS Remaining

SELECT * FROM branch_master WHERE districtName = 'Amravati' GROUP BY blockName

SELECT COUNT(bm.branchId),bm.districtName  FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  AND bm.branchId < 10000 GROUP BY bm.districtName


SELECT districtName,SUM(Total),SUM(downloads),SUM(remaining) FROM(
SELECT bm.districtName,COUNT(bm.branchId) Total,0 downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  AND bm.branchId < 10000 GROUP BY bm.districtName
UNION
SELECT bm.districtName,0 Total,COUNT(bm.branchId) downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName
UNION
SELECT  bm.districtName,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId in(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName) countTable 
GROUP BY countTable.districtName

SELECT bm.districtName,COUNT(am.animalId) AS animalCount  
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000 
GROUP BY bm.districtName

SELECT bm.blockName,COUNT(am.animalId) AS animalCount  
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001)  
AND bm.branchId < 10000 
GROUP BY bm.blockName

SELECT bm.centre_type,COUNT(am.animalId) AS animalCount
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 500001)  
AND bm.branchId < 10000 
GROUP BY bm.centre_type

cases -
SELECT COUNT(bm.branchId), bm.districtName FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 100001
GROUP BY bm.districtName

SELECT COUNT(bm.branchId), bm.blockName FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 200001
GROUP BY bm.blockName

SELECT COUNT(bm.branchId), bm.branchName FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 300001
GROUP BY bm.branchName

SELECT COUNT(bm.branchId), bm.centre_type FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE bmm.branchId = 500006 
GROUP BY bm.centre_type 


SELECT districtName,SUM(animals),SUM(cases) FROM(
SELECT bm.districtName,COUNT(am.animalId) animals,0 cases
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE  bmm.branchId = 100001 
GROUP BY bm.districtName
    UNION 
SELECT bm.districtName,0 animals,COUNT(bm.branchId) cases
FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 100001
GROUP BY bm.districtName) counTable 
GROUP BY counTable.districtName


SELECT  branch,SUM(animals) animals,SUM(cases) cases FROM( 
SELECT bm.blockName branch,COUNT(am.animalId) animals,0 cases 
FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 200001 
GROUP BY bm.blockName 
UNION 
SELECT bm.blockName branch,0 animals,COUNT(bm.branchId) cases 
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE bmm.branchId = 200001 GROUP BY bm.blockName) counTable 
GROUP BY counTable.branch 


SELECT branch,SUM(animals) animals,SUM(cases) cases FROM(
SELECT bm.branchName branch,COUNT(am.animalId) animals,0 cases
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE  bmm.branchId = 300004
GROUP BY bm.branchName
    UNION 
SELECT bm.branchName branch,0 animals,COUNT(bm.branchId) cases
FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 300004
GROUP BY bm.branchName) counTable 
GROUP BY counTable.branch


SELECT branch,SUM(animals) animals,SUM(cases) cases FROM(
SELECT bm.centre_type branch,COUNT(am.animalId) animals,0 cases
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE  bmm.branchId = 500006
GROUP BY bm.centre_type
    UNION 
SELECT bm.centre_type branch,0 animals,COUNT(bm.branchId) cases
FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId INNER JOIN user_master um ON um.branchId = bm.branchId INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 500006
GROUP BY bm.centre_type
UNION
SELECT count(bm.branchId),bm.blockName 
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 200001 
GROUP BY bm.blockName)counTable
GROUP BY counTable.branch

SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
SELECT bm.blockName branch,COUNT(am.animalId) animals,0 cases,0 AI 
FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 200001 
GROUP BY bm.blockName 
UNION 
SELECT bm.blockName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE bmm.branchId = 200001 GROUP BY bm.blockName
UNION
SELECT bm.blockName branch,0 animals,0 cases,count(bm.branchId) AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 200001 
GROUP BY bm.blockName) counTable 
GROUP BY counTable.branch


SELECT count(bm.branchId),bm.blockName 
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 200001 
GROUP BY bm.blockName


SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
SELECT bm.districtName branch,COUNT(am.animalId) animals,0 cases,0 AI 
FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 100001 
GROUP BY bm.districtName 
UNION 
SELECT bm.districtName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE bmm.branchId = 100001 GROUP BY bm.districtName
UNION
SELECT bm.districtName branch,0 animals,0 cases,count(bm.branchId) AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 100001 
GROUP BY bm.districtName) counTable 
GROUP BY counTable.branch

SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
SELECT bm.branchName branch,COUNT(am.animalId) animals,0 cases,0 AI 
FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 300001 
GROUP BY bm.branchName 
UNION 
SELECT bm.branchName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE bmm.branchId = 300001 GROUP BY bm.branchName
UNION
SELECT bm.branchName branch,0 animals,0 cases,count(bm.branchId) AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 300001 
GROUP BY bm.branchName) counTable 
GROUP BY counTable.branch

SELECT SUM(Total) Total,SUM(Downloads) Downloads FROM(
SELECT 0 Total,COUNT(bm.branchId) Downloads FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN otp_master om ON om.branchId = bm.branchId
WHERE bmm.branchId = 200001 AND bm.branchId < 10000
    UNION
    SELECT COUNT(bm.branchId) Total,0 Downloads FROM branch_master bm
 INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
 WHERE bmm.branchId = 200001 AND bm.branchId < 10000) CounTable

SELECT branch,SUM(PD) PD,SUM(AI) AI FROM(
SELECT bm.districtName branch,0 PD,count(bm.branchId) AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 200001 
GROUP BY bm.districtName
UNION
SELECT bm.districtName branch,count(bm.branchId) PD,0 AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'NSPD|AIPD' 
AND bmm.branchId = 100001 
GROUP BY bm.districtName) CounTable
GROUP BY CounTable.branch 


SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
SELECT bm.centre_type branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 500006
GROUP BY bm.centre_type
UNION
SELECT bm.centre_type branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'NSPD|AIPD' 
AND bmm.branchId = 500006 
GROUP BY bm.centre_type
UNION
SELECT bm.centre_type branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId = 500006
GROUP BY bm.centre_type
UNION
SELECT bm.centre_type branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' 
AND bmm.branchId = 500006 
GROUP BY bm.centre_type) CounTable
GROUP BY CounTable.branch

#count of applications downloaded
SELECT SUM(Total),SUM(downloads) FROM(
SELECT COUNT(bm.branchId) Total,0 downloads  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001)  AND bm.branchId < 10000
UNION
SELECT 0 Total,COUNT(bm.branchId) downloads  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 200001) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000) CounTable

#count of total farmers registered
SELECT COUNT(aom.ownerId) AS Farmercount  
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 100001
AND bm.branchId < 10000

#count of animals or tagged
SELECT SUM(animalCount) animalCount,SUM(tagged) tagged FROM(
SELECT COUNT(am.animalId) AS animalCount,0 tagged 
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000
UNION
SELECT 0 animalCount,COUNT(am.animalId) tagged    
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000
AND am.animalName regexp '^[0-9]{1,16}$') CounTable


#count of castration
SELECT count(*) 
FROM medication_master mm 
WHERE treatment REGEXP 'Procedure\":\"Closed|Procedure\":\"Open' 
AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                 INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)

#count of vaccination
SELECT COUNT(*) FROM vaccination_master mm 
WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um 
                    JOIN branch_master bm ON bm.branchId = um.branchId 
                    INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)

#count of operations
SELECT 0 castration, 0 vaccination,COUNT(*) operations,0 IPD,0 deworming 
FROM medication_master mm 
WHERE treatment REGEXP 'surgeryTypes\":\"[[a-z]|[A-Z]]' 
AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                 INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)

#count of deworming
SELECT 0 castration, 0 vaccination,0 operations,0 IPD,COUNT(*) deworming  FROM deworming_master mm 
WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                    INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)

#count of IPD paper
SELECT 0 castration, 0 vaccination,0 operations,COUNT(*) IPD,0 deworming FROM ipd_medication_master mm 
WHERE doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                   INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)

#whole query
SELECT SUM(castration) castration,SUM(vaccination) vaccination,SUM(operations) operations,SUM(IPD) IPD,SUM(deworming) deworming FROM(
    SELECT count(*) castration,0 vaccination,0 operations,0 IPD,0 deworming
FROM medication_master mm 
WHERE treatment REGEXP 'Procedure\":\"Closed|Procedure\":\"Open' 
AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                 INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001 AND bm.branchId < 10000)
    UNION
    SELECT 0 castration,COUNT(*) vaccination,0 operations,0 IPD,0 deworming FROM vaccination_master mm 
WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um 
                    JOIN branch_master bm ON bm.branchId = um.branchId 
                    INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)
    UNION
    SELECT 0 castration, 0 vaccination,COUNT(*) operations,0 IPD,0 deworming 
FROM medication_master mm 
WHERE treatment REGEXP 'surgeryTypes\":\"[[a-z]|[A-Z]]' 
AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                 INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)
    UNION
    SELECT 0 castration, 0 vaccination,0 operations,0 IPD,COUNT(*) deworming  FROM deworming_master mm 
WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                    INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)
    UNION
    SELECT 0 castration, 0 vaccination,0 operations,COUNT(*) IPD,0 deworming FROM ipd_medication_master mm 
WHERE doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                   INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = 100001)
)counTable

#whole query downloadable

SELECT SUM(animalCount) animalCount,SUM(tagged) tagged,SUM(farmercount) farmercount,SUM(Total) Total,SUM(downloads) downloads FROM(
SELECT COUNT(am.animalId) AS animalCount,0 tagged,0 farmercount,0 Total,0 downloads
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000
UNION
SELECT 0 animalCount,0 tagged,COUNT(aom.ownerId) AS farmercount,0 Total,0 downloads  
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 100001
AND bm.branchId < 10000)CounTable
UNION
SELECT 0 animalCount,0 tagged,0 farmercount,COUNT(bm.branchId) Total,0 downloads  FROM branch_master bm 
    WHERE bm.branchId IN(SELECT bmm.childBranch 
                         FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
    AND bm.branchId < 10000
UNION
SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,COUNT(bm.branchId) downloads  
    FROM branch_master bm 
    WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001) 
    AND bm.branchId  IN(SELECT branchId FROM otp_master) 
    AND bm.branchId < 10000) CounTable
UNION
SELECT 0 animalCount,COUNT(am.animalId) tagged,0 farmercount,0 Total,0 downloads    
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000
AND am.animalName regexp '^[0-9]{1,16}$'

#total revenue
SELECT SUM(fm.feesAmount) FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId 
WHERE bm.branchId 
IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)
AND bm.branchId < 10000 

#vd total marked
SELECT COUNT(*) FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 200001 AND bm.branchId < 10000 AND bm.isActive = 1 AND bm.latitude != 0 AND bm.longitude !=0

SELECT SUM(animalCount) animalCount,SUM(tagged) tagged,SUM(farmercount) farmercount,SUM(Total) Total,SUM(downloads) downloads,SUM(vd) vd,SUM(revenue) revenue FROM(
        SELECT COUNT(am.animalId) AS animalCount,0 tagged,0 farmercount,0 Total,0 downloads,0 vd,0 revenue
        FROM branch_master bm
        INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId
        WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
        AND bm.branchId < 10000
        UNION
        SELECT 0 animalCount,COUNT(am.animalId) tagged,0 farmercount,0 Total,0 downloads,0 vd,0 revenue    
        FROM branch_master bm
        INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId
        WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
        AND bm.branchId < 10000
        AND am.animalName regexp '^[0-9]{1,16}$'
        UNION
        SELECT 0 animalCount,0 tagged,COUNT(aom.ownerId) AS farmercount,0 Total,0 downloads,0 vd,0 revenue
        FROM branch_master bm
        INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = 100001
        AND bm.branchId < 10000
        UNION
        SELECT 0 animalCount,0 tagged,0 farmercount,COUNT(bm.branchId) Total,0 downloads,0 vd,0 revenue  FROM branch_master bm 
            WHERE bm.branchId IN(SELECT bmm.childBranch 
                                 FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
            AND bm.branchId < 10000
        UNION
        SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,COUNT(bm.branchId) downloads,0 vd,0 revenue  
            FROM branch_master bm 
            WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001) 
            AND bm.branchId  IN(SELECT branchId FROM otp_master) 
            AND bm.branchId < 10000
            UNION
            SELECT  0 animalCount,0 tagged,0 farmercount,0 Total,0 downloads ,COUNT(bm.branchId) vd,0 revenue
            FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
            WHERE bmm.branchId = 100001 AND bm.branchId < 10000 AND bm.isActive = 1 
            AND bm.latitude != 0 AND bm.longitude !=0 
            UNION
            SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,0 downloads ,0 vd,SUM(fm.feesAmount) revenue
            FROM branch_master bm 
            INNER JOIN fees_master fm ON fm.branchId = bm.branchId 
            WHERE bm.branchId 
            IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)
            AND bm.branchId < 10000) CounTable


 

#active institutes
SELECT bm.districtName branch, COUNT(DISTINCT(mm.doctorId)) AInst
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch 
WHERE bmm.branchId = 100001 
AND bm.branchId < 10000 
GROUP BY bm.districtName
#Total revenue
SELECT bm.districtName branch,SUM(fm.feesAmount) FAmt
FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId 
WHERE bm.branchId 
IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)
AND bm.branchId < 10000
GROUP BY bm.districtName
#vd marked total
SELECT bm.districtName branch,COUNT(bm.branchId) vds
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 100001 AND bm.branchId < 10000 
AND bm.isActive = 1 AND bm.latitude != 0 
AND bm.longitude !=0 GROUP BY bm.districtName


#whole query vds amount,active institutes
SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
SELECT bm.centre_type branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch 
WHERE bmm.branchId = 400001 
AND bm.branchId < 10000 
GROUP BY bm.centre_type
    UNION
SELECT bm.centre_type branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId 
WHERE bm.branchId 
IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 400001)
AND bm.branchId < 10000
GROUP BY bm.centre_type
    UNION
    SELECT bm.centre_type branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 400001 AND bm.branchId < 10000 
AND bm.isActive = 1 AND bm.latitude != 0 
AND bm.longitude !=0 GROUP BY bm.centre_type
) CounTable GROUP BY CounTable.branch

SELECT branch,SUM(Castration) Castration,SUM(vaccination) vaccination,SUM(IPD) IPD,SUM(deworm) deworm FROM(
        SELECT bm.branchName branch,count(bm.branchId) Castration,0 vaccination,0 IPD,0 deworm
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE treatment REGEXP 'Procedure\":\"Closed|Procedure\":\"Open' 
        AND bm.branchId < 10000
        AND bmm.branchId = 200001 
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 Castration,SUM(vm.cow + vm.bull + vm.buffalo + vm.redka + vm.calf + vm.goat + vm.sheep + vm.poultry) vaccination,0 IPD,0 deworm
        FROM vaccination_master vm 
        INNER JOIN branch_master bm ON bm.branchId = vm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = 200001
        AND bm.branchId < 10000
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 Castration,0 vaccination ,COUNT(*) IPD,0 deworm
        FROM ipd_medication_master imm
        INNER JOIN branch_master bm ON bm.branchId = imm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = 200001
        AND bm.branchId < 10000
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 Castration,0 vaccination ,0 IPD,COUNT(*) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = 200001
        AND bm.branchId < 10000
        GROUP BY bm.branchName) CounTable
        GROUP BY CounTable.branch

            SELECT bm.districtName,COUNT(am.animalId) AS animalCount,0 tagged,0 farmercount,0 Total,0 downloads,0 vd,0 revenue
            FROM branch_master bm
            INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
            INNER JOIN animal_master am ON am.ownerId = aom.ownerId
            WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
            AND bm.branchId < 10000
            GROUP BY bm.districtName


SELECT branch,SUM(animalCount) animalCount,SUM(farmercount) farmercount FROM(
SELECT bm.centre_type branch,COUNT(am.animalId) AS animalCount,0 farmercount
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 500001)  
AND bm.branchId < 10000
    GROUP BY bm.centre_type
UNION
SELECT bm.centre_type branch,0 animalCount,COUNT(aom.ownerId) AS farmercount
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 500001
AND bm.branchId < 10000
 GROUP BY bm.centre_type)CounTable
 GROUP BY CounTable.branch

 SELECT branch,SUM(animalCount) animalCount,SUM(farmercount) farmercount FROM(
SELECT bm.districtName branch,COUNT(am.animalId) AS animalCount,0 farmercount
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN animal_master am ON am.ownerId = aom.ownerId
WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = 100001)  
AND bm.branchId < 10000
    GROUP BY bm.districtName
UNION
SELECT bm.districtName branch,0 animalCount,COUNT(aom.ownerId) AS farmercount
FROM branch_master bm
INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
WHERE bmm.branchId = 100001
AND bm.branchId < 10000
 GROUP BY bm.districtName)CounTable
 GROUP BY CounTable.branch

SELECT mm.visitDate AS 'Visit Date' , aom.firstName AS 'First Name', aom.lastName AS 'Last Name',aom.address AS 'Address',aom.category AS 'Category' ,am.specie AS 'Species',  am.breed AS 'Breed',mm.treatment, mm.samples AS 'Samples' FROM medication_master  mm 
join animal_master am on mm.animalId = am.animalId 
join animal_owner_master aom on am.ownerId = aom.ownerId 
where mm.branchId = 419 
and mm.treatment REGEXP 'AIType":"[[a-z]|[A-Z]]'

SELECT mm.visitDate AS 'Visit Date' , aom.firstName AS 'First Name', aom.lastName AS 'Last Name',aom.address AS 'Address',aom.category AS 'Category' ,am.specie AS 'Species', am.breed AS 'Breed',mm.treatment, mm.samples AS 'Samples' FROM medication_master mm join animal_master am on mm.animalId = am.animalId join animal_owner_master aom on am.ownerId = aom.ownerId where mm.branchId = 3248 and mm.treatment REGEXP '"AIType":"Fresh'

SELECT mm.visitDate AS 'Visit Date' , aom.firstName AS 'First Name', aom.lastName AS 'Last Name',aom.address AS 'Address',aom.category AS 'Category' ,am.specie AS 'Species',  am.breed AS 'Breed',mm.treatment, mm.samples AS 'Samples' FROM medication_master  mm 
join animal_master am on mm.animalId = am.animalId 
join animal_owner_master aom on am.ownerId = aom.ownerId 
where mm.branchId = 3248 
and mm.treatment REGEXP '"AIType":"Repeat 2'

SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
FROM medication_master  mm 
    join animal_master am on mm.animalId = am.animalId 
    join animal_owner_master aom on am.ownerId = aom.ownerId 
    where mm.branchId = 3248
    AND MONTH(mm.visitDate) = 10 AND YEAR(mm.visitDate) = 2019
    and mm.treatment REGEXP 'AIType":"Repeat 1'
<option value="AIFresh">Artificial Insemination(Fresh)</option>
                                        <option value="AIRepeat1">Artificial Insemination(Repeat-1)</option>
                                        <option value="AIRepeat2">Artificial Insemination(repeat-2)</option>
                                        <option value="AIType">Total Artificial Inseminations</option>
                                        <option value="Delivery">Calves Born</option>
                                        <option value="Vaccine">Vaccination</option>
                                        <option value="Infertility">Infertility</option>
                                        <option value="Deworming">Deworming</option>
                                        <option value="CashRegister">Cash Register</option>
                                        <option value="Castration">Castrations</option>
                                        <option value="Operation">Operations</option>
                                        <option value="IPD">Inpatients</option>
                                        <option value="OPD">Outpatients</option>
                                        <option value="DayBook">Day Book</option>
                                        <option value="Tour">Tour Book</option>

                                         JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = 3248
            AND MONTH(mm.visitDate) = 09 AND YEAR(mm.visitDate) = 2019


            SELECT region,districtname,SUM(login) login,SUM(remaining) remaining FROM(
Select districtname as region,blockname as districtname,count(centre_type) as login,0 remaining from branch_master
Where branchid IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname
    UNION
    Select districtname as region,blockname as districtname,0 login,count(centre_type) as remaining  from branch_master
Where branchid NOT IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname) CounTable
GROUP BY CounTable.districtname ORDER BY CounTable.region

SELECT region,districtname,SUM(login) login,SUM(remaining) remaining,SUM(AI) AI FROM(
Select districtname as region,blockname as districtname,count(centre_type) as login,0 remaining,0 AI from branch_master
Where branchid IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname
    UNION
    Select districtname as region,blockname as districtname,0 login,count(centre_type) as remaining,0 AI  from branch_master
Where branchid NOT IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname
    UNION
    SELECT districtname as region,blockname as districtname,0 login,0 remaining,COUNT(bm.branchId) AI
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId= 100001 AND bm.branchId < 10000
GROUP BY bm.blockName
) CounTable
GROUP BY CounTable.districtname ORDER BY CounTable.region

#Total Downloads,remaining,AI,cases by blockwise
SELECT region,districtname,SUM(login) login,SUM(remaining) remaining,SUM(AI) AI,SUM(cases) cases FROM(
Select districtname as region,blockname as districtname,count(centre_type) as login,0 remaining,0 AI,0 cases from branch_master
Where branchid IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname
    UNION
    Select districtname as region,blockname as districtname,0 login,count(centre_type) as remaining,0 AI,0 cases  from branch_master
Where branchid NOT IN (Select branchid from otp_master where isverified=1 and branchid < 10000)
And branchid <10000 
Group by blockname
    UNION
    SELECT districtname as region,blockname as districtname,0 login,0 remaining,COUNT(bm.branchId) AI,0 cases
FROM branch_master bm 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
AND bmm.branchId= 100001 AND bm.branchId < 10000
GROUP BY bm.blockName
    UNION
    SELECT districtname as region,blockname as districtname,0 login,0 remaining,0 AI,COUNT(bm.branchId) as cases
    FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN user_master um ON um.branchId = bm.branchId 
INNER JOIN medication_master mm ON mm.doctorId = um.doctorId
WHERE bmm.branchId = 100001 AND bm.branchId < 10000
GROUP BY bm.blockName
) CounTable
GROUP BY CounTable.districtname ORDER BY CounTable.region

SELECT COUNT(aom.ownerId) AS farmercount
            FROM branch_master bm
            INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
            INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
            WHERE bmm.branchId = 100001 AND aom.mobile in(SELECT mobile FROM otp_master_farmer)
            AND bm.branchId < 10000
        SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.districtName branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = 100001 AND bm.branchId < 10000
         GROUP BY bm.districtName
         UNION
         SELECT bm.districtName branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = 100001
        AND bm.branchId < 10000
        GROUP BY bm.districtName)CounTable GROUP BY CounTable.branch
 
 rjc_pune rjt8x7ac id=200007
 daho_pune 497a1df7 id=300030
 tal_ambegaon tzzrjnht id=500289

 SELECT * FROM advertisement_mapping amm INNER JOIN advertisement_master am ON amm.addId = am.adId WHERE CURRENT_DATE BETWEEN amm.fromDate AND amm.toDate
