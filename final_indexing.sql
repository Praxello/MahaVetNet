DELETE FROM medication_master  WHERE medication_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master);
ALTER TABLE medication_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);
ALTER TABLE medication_master ADD FOREIGN KEY(doctorId) REFERENCES user_master(doctorId);
ALTER TABLE medication_master ADD FOREIGN KEY(animalId) REFERENCES animal_master(animalId)

ALTER TABLE vaccination_master ADD FOREIGN KEY(doctorId) REFERENCES user_master(doctorId);
ALTER TABLE vaccination_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

DELETE FROM user_master WHERE user_master.branchId NOT IN(SELECT branch_master.branchId FROM branch_master)
ALTER TABLE user_master ADD FOREIGN KEY(branchId) REFERENCES branch_master(branchId);

ALTER TABLE ipd_medication_master ADD FOREIGN KEY(animalId) REFERENCES animal_master(animalId)