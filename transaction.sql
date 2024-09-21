CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10),
    tenant_name VARCHAR(100),
    bill_type VARCHAR(50),
    amount_paid DECIMAL(10, 2),
    date_paid DATE,
    proof_of_payment VARCHAR(255)
);
