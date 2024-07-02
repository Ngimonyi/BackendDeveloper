-- Drop the database if it exists
DROP DATABASE IF EXISTS company;

-- Create the database
CREATE DATABASE IF NOT EXISTS company DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Use the database
USE company;

-- Create the employee table
CREATE TABLE IF NOT EXISTS employee (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    employee_name VARCHAR(45) NOT NULL,
    employee_surname VARCHAR(45) NOT NULL,
    employee_address VARCHAR(45) NOT NULL,
    phone VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    salary DECIMAL(10,2) NOT NULL
);

-- Create the department table
CREATE TABLE IF NOT EXISTS department (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    department_name VARCHAR(45) NOT NULL,
    leader INT UNSIGNED NOT NULL,
    FOREIGN KEY (leader) REFERENCES employee(id)
);

-- Create the employee_department table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS employee_department (
    employee_id INT UNSIGNED NOT NULL,
    department_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employee(id),
    FOREIGN KEY (department_id) REFERENCES department(id)
);

-- Insert data into employee table
INSERT INTO employee (employee_name, employee_surname, employee_address, phone, email, salary) VALUES
    ('Ndaroi', 'Domo', '123 Main St', '555-1234', 'ndaroi.domo@example.com', 1000.00),
    ('Jane', 'Smith', '456 Oak Ave', '555-5678', 'jane.smith@example.com', 950.00),
    ('Michael', 'Johnson', '789 Elm Blvd', '555-9012', 'michael.johnson@example.com', 1050.00),
    ('Emily', 'Williams', '101 Pine Rd', '555-3456', 'emily.williams@example.com', 1050.00),
    ('David', 'Brown', '202 Cedar Dr', '555-7890', 'david.brown@example.com', 1050.00),
    ('Sarah', 'Jones', '303 Birch Ln', '555-2345', 'sarah.jones@example.com', 700.00),
    ('Daniel', 'Garcia', '404 Maple Ct', '555-6789', 'daniel.garcia@example.com', 1050.00),
    ('Maria', 'Martinez', '505 Pineapple Dr', '555-4321', 'maria.martinez@example.com', 1200.00),
    ('Christopher', 'Davis', '606 Orange Blvd', '555-8765', 'christopher.davis@example.com', 1500.00),
    ('Jessica', 'Rodriguez', '707 Apple St', '555-2109', 'jessica.rodriguez@example.com', 700.00),
    ('Matthew', 'Hernandez', '808 Banana Ave', '555-6543', 'matthew.hernandez@example.com', 1000.00);

-- Insert data into department table
INSERT INTO department (department_name, leader) VALUES
    ('Sales', 4),
    ('Marketing', 4),
    ('Finance', 5),
    ('Warehouse', 8),
    ('IT', 9);

-- Insert data into employee_department table
INSERT INTO employee_department (employee_id, department_id) VALUES
    (1, 1),
    (1, 2),
    (2, 1),
    (2, 2),
    (3, 1),
    (4, 1),
    (4, 2),
    (5, 3),
    (6, 3),
    (7, 3),
    (8, 4),
    (9, 5),
    (10, 5),
    (11, 5);

-- Retrieve all employees and their salaries
SELECT CONCAT(employee_name, ' ', employee_surname) AS 'Full Name', salary AS 'Salary'
FROM employee; 

Results:
-- +---------------------+---------+
-- | Full Name           | Salary  |
-- +---------------------+---------+
-- | Ndaroi Domo         | 1000.00 |
-- | Jane Smith          | 950.00  |
-- | Michael Johnson     | 1050.00 |
-- | Emily Williams      | 1050.00 |
-- | David Brown         | 1050.00 |
-- | Sarah Jones         | 700.00  |
-- | Daniel Garcia       | 1050.00 |
-- | Maria Martinez      | 1200.00 |
-- | Christopher Davis   | 1500.00 |
-- | Jessica Rodriguez   | 700.00  |
-- | Matthew Hernandez   | 1000.00 |
-- +---------------------+---------+

-- Retrieve all department leaders and calculate the average of their salaries
SELECT ROUND(SUM(e.salary) / COUNT(e.id), 2) AS 'Average Salary of Leaders'
FROM employee e
JOIN department d ON d.leader = e.id;

Results:
-- +---------------------------+
-- | Average Salary of Leaders |
-- +---------------------------+
-- |                   1170.00 |
-- +---------------------------+

-- Create a procedure to calculate the average salary of all employees
DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS calculate_average_salary() 
BEGIN
    SELECT ROUND(AVG(salary), 2) AS 'Average Salary' FROM employee;
END $$

DELIMITER ;

-- Example of calling the stored procedure to calculate average salary
CALL calculate_average_salary();

Results:
-- +-----------------+
-- | Average Salary  |
-- +-----------------+
-- |         1027.27 |
-- +-----------------+

-- Employees by department
SELECT CONCAT(e.employee_name, ' ', e.employee_surname) AS Employee, d.department_name AS 'Department'
FROM employee e
JOIN employee_department ed ON e.id = ed.employee_id
JOIN department d ON d.id = ed.department_id
GROUP BY Employee, d.department_name;

Results:
-- +------------------+--------------+
-- | Employee         | Department   |
-- +------------------+--------------+
-- | Ndaroi Domo      | Sales        |
-- | Ndaroi Domo      | Marketing    |
-- | Jane Smith       | Sales        |
-- | Jane Smith       | Sales        |
-- | Michael Johnson  | Sales        |
-- | Emily Williams   | Sales        |
-- | Emily Williams   | Marketing    |
-- | David Brown      | Finance      |
-- | Sarah Jones      | Finance      |
-- | Daniel Garcia    | Finance      |
-- | Maria Martinez   | Warehouse    |
-- | Christopher Davis| IT           |
-- | Jessica Rodriguez| IT           |
-- | Matthew Hernandez| IT           |
-- +------------------+--------------+

-- Department leaders
SELECT d.department_name AS 'Department', CONCAT(e.employee_name, ' ', e.employee_surname) AS 'Leader'
FROM department d
JOIN employee e ON e.id = d.leader;

Results:
-- +--------------+-----------------+
-- | Department   | Leader          |
-- +--------------+-----------------+
-- | Sales        | Emily Williams  |
-- | Marketing    | Emily Williams  |
-- | Finance      | David Brown     |
-- | Warehouse    | Maria Martinez  |
-- | IT           | Christopher Davis|
-- +--------------+-----------------+
