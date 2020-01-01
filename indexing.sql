
DELETE FROM user_master WHERE user_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master);
ALTER TABLE user_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

ALTER TABLE animal_owner_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

DELETE FROM medication_master  WHERE medication_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master);
ALTER TABLE medication_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);
ALTER TABLE medication_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

ALTER TABLE vaccination_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);


ALTER TABLE deworming_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

DELETE FROM ipd_medication_master  WHERE ipd_medication_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master);
ALTER TABLE ipd_medication_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);
DELETE FROM fees_master WHERE fees_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master);

