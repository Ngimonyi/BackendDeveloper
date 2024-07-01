
-- Drop the database if it exists
DROP DATABASE IF EXISTS company;

-- Create the database
CREATE DATABASE IF NOT EXISTS company DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Use the database
USE company;

-- Create employees table
CREATE TABLE IF NOT EXISTS employees (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    first_name VARCHAR(45) NOT NULL,
    last_name VARCHAR(45) NOT NULL,
    address VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    salary DECIMAL(10,2) NOT NULL
);

-- Create departments table
CREATE TABLE IF NOT EXISTS departments (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    department_name VARCHAR(45) NOT NULL
);

-- Create employee_departments table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS employee_departments (
    employee_id INT UNSIGNED NOT NULL,
    department_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (employee_id, department_id),
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- Create department_leaders table (to store leaders of departments)
CREATE TABLE IF NOT EXISTS department_leaders (
    department_id INT UNSIGNED NOT NULL PRIMARY KEY,
    leader_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (department_id) REFERENCES departments(id),
    FOREIGN KEY (leader_id) REFERENCES employees(id)
);


-- Insert data into employees table
INSERT INTO employees (first_name, last_name, address, phone_number, email, salary) VALUES
    ('John', 'Doe', '123 Main St', '555-1234', 'john.doe@example.com', 850.00),
    ('Jane', 'Smith', '456 Oak Ave', '555-5678', 'jane.smith@example.com', 950.00),
    ('Michael', 'Johnson', '789 Elm Blvd', '555-9012', 'michael.johnson@example.com', 1050.00),
    ('Emily', 'Williams', '101 Pine Rd', '555-3456', 'emily.williams@example.com', 1550.00),
    ('David', 'Brown', '202 Cedar Dr', '555-7890', 'david.brown@example.com', 1000.00),
    ('Sarah', 'Jones', '303 Birch Ln', '555-2345', 'sarah.jones@example.com', 900.00),
    ('Daniel', 'Garcia', '404 Maple Ct', '555-6789', 'daniel.garcia@example.com', 1030.00),
    ('Maria', 'Martinez', '505 Pineapple Dr', '555-4321', 'maria.martinez@example.com', 1200.00),
    ('Christopher', 'Davis', '606 Orange Blvd', '555-8765', 'christopher.davis@example.com', 1500.00),
    ('Jessica', 'Rodriguez', '707 Apple St', '555-2109', 'jessica.rodriguez@example.com', 700.00),
    ('Matthew', 'Hernandez', '808 Banana Ave', '555-6543', 'matthew.hernandez@example.com', 1000.00);

-- Insert data into departments table
INSERT INTO departments (department_name) VALUES
    ('Sales'),
    ('Marketing'),
    ('Finance'),
    ('Warehouse'),
    ('IT');

-- Insert data into employee_departments table
INSERT INTO employee_departments (employee_id, department_id) VALUES
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

-- Insert data into department_leaders table
INSERT INTO department_leaders (department_id, leader_id) VALUES
    (1, 4), -- Sales led by Michael Johnson
    (2, 4), -- Marketing led by Michael Johnson
    (3, 5), -- Finance led by David Brown
    (4, 8), -- Warehouse led by Maria Martinez
    (5, 9); -- IT led by Christopher Davis

-- Step 5: Perform Queries

-- Retrieve all employees and their salaries
SELECT CONCAT(first_name, ' ', last_name) AS 'Full Name', salary AS 'Salary'
FROM employees;

-- Fetch all department leaders and calculate the average of their salaries
SELECT d.department_name AS 'Department', ROUND(AVG(e.salary), 2) AS 'Average Salary'
FROM departments d
JOIN department_leaders dl ON d.id = dl.department_id
JOIN employees e ON dl.leader_id = e.id
GROUP BY d.department_name;

-- Create a procedure to calculate the average salary of all employees
DELIMITER $$
CREATE PROCEDURE IF NOT EXISTS calculate_average_salary()
BEGIN
    SELECT ROUND(AVG(salary), 2) AS 'Average Salary' FROM employees;
END $$
DELIMITER ;

-- Example of calling the stored procedure to calculate average salary
CALL calculate_average_salary();

-- Fetch employees by departments
SELECT CONCAT(e.first_name, ' ', e.last_name) AS Employee, d.department_name AS 'Department'
FROM employees e
JOIN employee_departments ed ON e.id = ed.employee_id
JOIN departments d ON ed.department_id = d.id
ORDER BY d.department_name, e.last_name;

-- Fetch department leaders
SELECT d.department_name AS 'Department', CONCAT(e.first_name, ' ', e.last_name) AS 'Department Leader'
FROM departments d
JOIN department_leaders dl ON d.id = dl.department_id
JOIN employees e ON dl.leader_id = e.id;
