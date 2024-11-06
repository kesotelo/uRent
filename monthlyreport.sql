-- monthlyreport.sql
CREATE TABLE IF NOT EXISTS monthlyreport (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_name VARCHAR(255) NOT NULL,
    room_number INT NOT NULL,
    electricity_status ENUM('Paid', 'Not Paid') DEFAULT 'Not Paid',
    water_status ENUM('Paid', 'Not Paid') DEFAULT 'Not Paid',
    rental_status ENUM('Paid', 'Not Paid') DEFAULT 'Not Paid',
    month INT NOT NULL,
    year INT NOT NULL,
    UNIQUE (tenant_name, room_number, month, year) -- Ensures unique records for each tenant per month and year
);
