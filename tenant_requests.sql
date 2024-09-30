CREATE TABLE tenant_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT,             
    room_number VARCHAR(10),
    tenant_name VARCHAR(255),
    request TEXT,
    status VARCHAR(20) DEFAULT 'pending',  -- This is the new status column
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
