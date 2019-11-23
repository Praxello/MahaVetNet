SELECT * FROM user_master WHERE user_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)

SELECT * FROM medication_master mm WHERE mm.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)

SELECT * FROM vaccination_master  WHERE vaccination_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)
SELECT * FROM deworming_master  WHERE deworming_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)

SELECT * FROM ipd_medication_master  WHERE ipd_medication_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)
SELECT * FROM animal_master WHERE animal_master.ownerId NOT IN(SELECT animal_owner_master.ownerId FROM animal_owner_master)
SELECT * FROM fees_master WHERE fees_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)