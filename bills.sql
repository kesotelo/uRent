CREATE TABLE bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant VARCHAR(100),
    roomNumber VARCHAR(50),
    electricityPaid TINYINT(1),
    waterPaid TINYINT(1),
    rentalPaid TINYINT(1),
    paymentDate DATE
);

