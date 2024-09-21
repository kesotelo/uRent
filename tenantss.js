function showPopup(type, roomNumber, username, email, phone) {
    let popup;
    switch (type) {
        case 'electricity':
            popup = document.getElementById('electricity-popup');
            document.getElementById('current-reading').innerText = '1234'; // eto yung sa hardware na need automate
            document.getElementById('previous-reading').innerText = '1200'; // eto yung sa hardware na need automate
            document.getElementById('receipt-items').innerHTML = `
                <tr>
                    <td>Electricity</td>
                    <td>${document.getElementById('previous-reading').innerText}</td> 
                    <td>${document.getElementById('current-reading').innerText}</td>
                    <td>₱${document.getElementById('total-bill').innerText}</td>
                </tr>`;
            break;
        case 'water':
            popup = document.getElementById('water-popup');
            document.getElementById('water-current-reading').innerText = '500'; // eto yung sa hardware na need automate
            document.getElementById('water-previous-reading').innerText = '450';// eto yung sa hardware na need automate
            document.getElementById('receipt-items').innerHTML = `
                <tr>
                    <td>Water</td>
                    <td>${document.getElementById('water-previous-reading').innerText}</td>
                    <td>${document.getElementById('water-current-reading').innerText}</td>
                    <td>₱${document.getElementById('water-total-bill').innerText}</td>
                </tr>`;
            break;
        case 'rental':
            popup = document.getElementById('rental-popup');
            document.getElementById('rent-amount').value = '5000'; //  rent amount
            document.getElementById('receipt-items').innerHTML = `
                <tr>
                    <td>Rental</td>
                    <td></td>
                    <td></td>
                    <td>₱${document.getElementById('rent-amount').value}</td>
                </tr>`;
            break;
        case 'receipt':
            popup = document.getElementById('receipt-popup');
            document.getElementById('receipt-room').innerText = roomNumber;
            updateReceiptTotal();
              // Generate current date
              const currentDate = new Date().toLocaleDateString();
              document.getElementById('receipt-date').innerText = currentDate;
  
              updateReceiptTotal();
              break;
        case 'info':
            popup = document.getElementById('info-popup');
            document.getElementById('tenant-name-info').innerText = username;
            document.getElementById('tenant-email-info').innerText = email;
            document.getElementById('tenant-phone-info').innerText = phone;
            document.getElementById('tenant-room-info').innerText = roomNumber;
            break;
        case 'add-tenant':
            popup = document.getElementById('add-tenant-popup');
            break;
    }
    popup.style.display = 'flex';
}

function closePopup(type) {
    let popup;
    switch (type) {
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
        case 'add-tenant':
            popup = document.getElementById('add-tenant-popup');
            break;
    }
    popup.style.display = 'none';
}

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

function updateReceiptTotal() {
    const electricityTotal = parseFloat(document.getElementById('total-bill').innerText) || 0;
    const waterTotal = parseFloat(document.getElementById('water-total-bill').innerText) || 0;
    const rentalTotal = parseFloat(document.getElementById('rent-amount').value) || 0;

    const totalAmount = electricityTotal + waterTotal + rentalTotal;
    document.getElementById('receipt-total').innerText = totalAmount.toFixed(2);
}

function markAsPaid() {
    const roomNumber = document.getElementById('receipt-room').innerText;
    const totalAmount = document.getElementById('receipt-total').innerText;

    // Send an AJAX request to update the backend
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_payment_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`room=${roomNumber}&amount=${totalAmount}&status=Paid`);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('The bill has been marked as Paid!');
            loadTable(); // Reload the table if necessary
        }
    };

    closePopup('receipt');
}

// Event listeners
document.getElementById('peso-per-kwh').addEventListener('input', autoCalculateElectricityBill);
document.getElementById('peso-per-cum').addEventListener('input', autoCalculateWaterBill);
document.getElementById('receipt-popup').addEventListener('show', updateReceiptTotal);

document.getElementById('add-tenant-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const name = document.getElementById('tenant-name').value;
    const email = document.getElementById('Email').value;
    const phone = document.getElementById('tenant-phone').value;
    const roomNumber = document.getElementById('tenant-room').value;

    // Send data to the server
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "addtenant.php", true); // Backend URL for adding tenants
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Create a query string from the form data
    const params = `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&roomNumber=${encodeURIComponent(roomNumber)}`;

    xhr.send(params);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Tenant added successfully!');
            closePopup('add-tenant');
            // Optionally, you can refresh the tenant list here
        }
    };
});