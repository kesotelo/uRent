function showPopup(type, roomNumber) {
    let popup;
    switch(type) {
        case 'electricity':
            popup = document.getElementById('electricity-popup');
            document.getElementById('current-reading').innerText = '1234'; // eto yung sa hardware na need automate
            document.getElementById('previous-reading').innerText = '1200'; // eto yung sa hardware na need automate
            break;
        case 'water':
            popup = document.getElementById('water-popup');
            document.getElementById('water-current-reading').innerText = '500'; // eto yung sa hardware na need automate
            document.getElementById('water-previous-reading').innerText = '450'; // eto yung sa hardware na need automate
            break;
        case 'rental':
            popup = document.getElementById('rental-popup');
            document.getElementById('rent-amount').value = '5000'; // eto yung sa hardware na need automate
            break;
        case 'receipt':
            popup = document.getElementById('receipt-popup');
            document.getElementById('receipt-room').innerText = `Room ${roomNumber}`;
            document.getElementById('receipt-total').innerText = 
                document.getElementById('total-bill').innerText || 
                document.getElementById('water-total-bill').innerText || 
                document.getElementById('rent-total-bill').innerText;
            break;
        case 'info':
            popup = document.getElementById('info-popup');
            document.getElementById('room-info').innerText = `Information for Room ${roomNumber}`;
            break;
    }
    popup.style.display = 'flex';
}

function closePopup(type) {
    let popup;
    switch(type) {
        case 'electricity':
            popup = document.getElementById('electricity-popup');
            break;
        case 'water':
            popup = document.getElementById('water-popup');
            break;
        case 'rental':
            popup = document.getElementById('rental-popup');
            break;
        case 'receipt':
            popup = document.getElementById('receipt-popup');
            break;
        case 'info':
            popup = document.getElementById('info-popup');
            break;
    }
    popup.style.display = 'none';
}

// Function to calculate electricity bill automatically
function autoCalculateElectricityBill() {
    const currentReading = parseFloat(document.getElementById('current-reading').innerText);
    const previousReading = parseFloat(document.getElementById('previous-reading').innerText);
    const pesoPerKwh = parseFloat(document.getElementById('peso-per-kwh').value);

    if (!isNaN(pesoPerKwh)) {
        const total = (currentReading - previousReading) * pesoPerKwh;
        document.getElementById('total-bill').innerText = total.toFixed(2);
    } else {
        document.getElementById('total-bill').innerText = ''; 
    }
}

// Function to calculate water bill automatically
function autoCalculateWaterBill() {
    const currentReading = parseFloat(document.getElementById('water-current-reading').innerText);
    const previousReading = parseFloat(document.getElementById('water-previous-reading').innerText);
    const pesoPerCum = parseFloat(document.getElementById('peso-per-cum').value);

    if (!isNaN(pesoPerCum)) {
        const total = (currentReading - previousReading) * pesoPerCum;
        document.getElementById('water-total-bill').innerText = total.toFixed(2);
    } else {
        document.getElementById('water-total-bill').innerText = ''; 
    }
}

// Function to update the receipt popup with the total amount
function updateReceiptTotal() {
    const electricityTotal = parseFloat(document.getElementById('total-bill').innerText) || 0;
    const waterTotal = parseFloat(document.getElementById('water-total-bill').innerText) || 0;
    const rentalTotal = parseFloat(document.getElementById('rent-total-bill').innerText) || 0;

    const totalAmount = electricityTotal + waterTotal + rentalTotal;
    document.getElementById('receipt-total').innerText = totalAmount.toFixed(2);
}

// Event listener to automatically calculate electricity bill
document.getElementById('peso-per-kwh').addEventListener('input', autoCalculateElectricityBill);

// Event listener to automatically calculate water bill
document.getElementById('peso-per-cum').addEventListener('input', autoCalculateWaterBill);

// Event listener to update receipt total when the receipt popup is shown
document.getElementById('receipt-popup').addEventListener('show', updateReceiptTotal);

// Mark as paid function
function markAsPaid() {
    const roomNumber = document.getElementById('receipt-room').innerText.split(' ')[1][2][3][4][5][6]; 
    const totalAmount = document.getElementById('receipt-total').innerText;
    
    // Send an AJAX request to update the backend
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_payment_status.php", true); // Backend URL
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`room=${roomNumber}&amount=${totalAmount}&status=Paid`);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('The bill has been marked as Paid!');
            // Reload the monthly bills table
            loadTable(); 
        }
    };

    closePopup('receipt'); 
}

