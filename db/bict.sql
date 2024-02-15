CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    student_number INT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE,
    date_of_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_of_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DELIMITER //
CREATE TRIGGER generate_student_number BEFORE INSERT ON students
FOR EACH ROW
BEGIN
    SET NEW.student_number = CONCAT(YEAR(CURRENT_DATE), 
                                    '-', LPAD(MONTH(CURRENT_DATE), 2, '0'), 
                                    '-', LPAD(DAY(CURRENT_DATE), 2, '0'), 
                                    '-', (SELECT IFNULL(MAX(student_number % 10000), 0) + 1 FROM students));
END;
//
DELIMITER ;
