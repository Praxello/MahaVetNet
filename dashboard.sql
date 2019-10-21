#CountQueries

AICount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
AIFreshCount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ? and mm.treatment REGEXP 'AIType\":\"Fresh'
AIRepeat1Count = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ? and mm.treatment REGEXP 'AIType\":\"Repeat 1'
AIRepeat2Count = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ? and mm.treatment REGEXP 'AIType\":\"Repeat 2'
DeliveryCount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
IPDCount = SELECT count(*) as 'Count' FROM ipd_medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
OPDCount = SELECT  count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
VaccineCount = SELECT  count(*) as 'Count'  FROM vaccination_master  mm  join animal_owner_master aom on(mm.ownerId = aom.ownerId) WHERE mm.doctorId=?
DewormingCount = SELECT count(*) as 'Count'  FROM deworming_master  mm  join animal_owner_master aom on(mm.ownerId = aom.ownerId) WHERE mm.doctorId=?
TourCount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ? AND mm.visitType='Tour'
CastrationCount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
InfertilityCount = SELECT  count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
PregnancyCount = SELECT count(*) as 'Count' FROM FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
OperationCount = SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
DayBookCount= SELECT count(*) as 'Count' FROM medication_master  mm join animal_master am on (mm.animalId = am.animalId) join animal_owner_master aom on(am.ownerId = aom.ownerId) where mm.doctorId = ?
CashRegisterCount = SELECT count(*) FROM `fees_master` mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on am.ownerid = aom.ownerid WHERE mm.doctorid = ?


#Dashboard Queries
DashAI = select count(*) from medication_master mm where treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
#DashAIFresh = select count(*) from medication_master where treatment REGEXP '\"AIType\"' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashAIRepeat1 = select count(*) from medication_master mm where treatment REGEXP 'AIType\":\"Repeat 1' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashAIRepeat2 = select count(*) from medication_master mm where treatment REGEXP 'AIType\":\"Repeat 2' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashDelivery = select count(*) from medication_master mm where treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashCastration = select count(*) from medication_master mm where treatment REGEXP 'Procedure\":\"Closed|Procedure\":\"Open' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashInfertility = select count(*) from medication_master mm where treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashOperation = select count(*) from medication_master mm where treatment REGEXP 'surgeryTypes\":\"[[a-z]|[A-Z]]' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashOPD = select count(*) from medication_master mm where doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashIPD = select count(*) from ipd_medication_master mm where doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashVaccine = select count(*) from vaccination_master mm where  doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashDeworming = select count(*) from deworming_master mm where  doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashPregnancy = select count(*) from medication_master mm where treatment REGEXP 'NSPD|AIPD' and doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId = ?)
DashApps = select count(DISTINCT(branchId)) from otp_master
DashAppsFrom = SELECT count(*) FROM branch_master WHERE branchId < ?
DashAnimalsRegistered = select  count(*) from branch_master bm inner join user_master um1 on bm.branchId = um1.branchId inner JOIN animal_owner_master aom1 on aom1.doctorId = um1.doctorId INNER join animal_master am on am.ownerId = aom1.ownerId where bm.branchId< 10000
DashActiveInstitutes = select count(distinct(doctorid)) from  medication_master
DashLocationCovered = SELECT count(DISTINCT(mm.latitude)) FROM medication_master mm
