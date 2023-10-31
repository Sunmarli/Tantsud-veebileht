CREATE TABLE tantsupaarid (
    paariID INT AUTO_INCREMENT PRIMARY KEY,
    hinne1 INT  DEFAULT 0,
    hinne2 INT  DEFAULT 0,
    hinne3 INT  DEFAULT 0,
    keskmine_hinne int
)

UPDATE tantsupaarid
SET keskmine_hinne = (hinne1 + hinne2 + hinne3) / 3;


CREATE TRIGGER calculate_average_after_insert
 BEFORE INSERT ON tantsupaarid
 FOR EACH ROW
 BEGIN
  UPDATE tantsupaarid SET keskmine_hinne = (hinne1 + hinne2 + hinne3) / 3;
  END;

  #1442 - Can't update table 'tantsupaarid' in stored function/trigger because it is already used by statement which invoked this stored function/trigger