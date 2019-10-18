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