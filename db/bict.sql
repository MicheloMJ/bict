CREATE DATABASE IF NOT EXISTS bict;

USE bict;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    student_number VARCHAR(50),
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
    DECLARE current_year_month_day VARCHAR(10);
    DECLARE current_milliseconds BIGINT;

    -- Get the current date in the format 'YYYY-MM-DD'
    SET current_year_month_day = CONCAT(YEAR(CURRENT_DATE), '-', LPAD(MONTH(CURRENT_DATE), 2, '0'), '-', LPAD(DAY(CURRENT_DATE), 2, '0'));

    -- Get the current time in milliseconds
    SET current_milliseconds = UNIX_TIMESTAMP(NOW(3)) * 1000;

    -- Set the new student number
    SET NEW.student_number = CONCAT(current_year_month_day, '-', current_milliseconds);
END;
//

DELIMITER ;

