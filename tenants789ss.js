function showPopup(type, roomNumber, username, email, phone) {
    let popup;
    switch (type) {
        case 'electricity':
            popup = document.getElementById('electricity-popup');
            document.getElementById('tenant-room-electricity').innerText = roomNumber;
            document.getElementById('tenant-name-electricity').innerText = username;
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
            document.getElementById('tenant-room-water').innerText = roomNumber;
            document.getElementById('tenant-name-water').innerText = username;
            document.getElementById('water-current-reading').innerText = '500'; // eto yung sa hardware na need automate
            document.getElementById('water-previous-reading').innerText = '450'; // eto yung sa hardware na need automate
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
            document.getElementById('tenant-room-rental').innerText = roomNumber;
            document.getElementById('tenant-name-rental').innerText = username;
            document.getElementById('rent-amount').value = '5000'; // rent amount
            document.getElementById('receipt-items').innerHTML = `
                <tr>
                    <td>Rental</td>
                    <td></td>
                    <td></td>
                    <td>₱${document.getElementById('rent-amount').value}</td>
                </tr>`;
            break;
                case 'mark-as-paid':
                    popup = document.getElementById('mark-paid-popup');
                    document.getElementById('popup-room-number').innerText = roomNumber; // Store the room number
                    document.getElementById('popup-tenant-name').innerText = username;  // Store tenant name
                    break;
            case 'receipt':
                popup = document.getElementById('receipt-popup');
    
                // Ensure the tenant name and room number are displayed correctly
                document.getElementById('receipt-tenant-name').innerText = username || 'N/A';
                document.getElementById('receipt-room').innerText = roomNumber || 'N/A';
    
                // Generate current date
                const currentDate = new Date().toLocaleDateString();
                document.getElementById('receipt-date').innerText = currentDate;
    
                // Update receipt total
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

    // Display the popup
    popup.style.display = 'flex';

    // Add event listener to close popup when clicking outside the content
    popup.addEventListener('click', function(event) {
        if (event.target === popup) {
            closePopup(type); // Close the popup if clicking outside the popup content
        }
    });
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

    // Hide the popup
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
    const paymentDate = new Date().toISOString().split('T')[0]; // Returns YYYY-MM-DD
    const billType = document.querySelector('#receipt-items tr td').innerText; // Determine the bill type (Electricity, Water, or Rental)

    const receiptContainer = document.querySelector('.receipt-container');

    // Temporarily convert to grayscale for black-and-white PDF export
    receiptContainer.style.filter = 'grayscale(100%)';

    const options = {
        margin: 1,
        filename: `receipt_${roomNumber}_${paymentDate}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Generate PDF and send it to the backend
    html2pdf().from(receiptContainer).set(options).output('blob').then(function(pdfBlob) {
        // Reset grayscale effect after saving
        receiptContainer.style.filter = '';

        // Create FormData to send PDF and payment data to the backend
        const formData = new FormData();
        formData.append('pdf', pdfBlob, `receipt_${roomNumber}_${paymentDate}.pdf`);
        formData.append('room_number', roomNumber);
        formData.append('amount', totalAmount);
        formData.append('bill_type', billType);
        formData.append('payment_date', paymentDate);

        // Send the data and PDF via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "save_payment.php", true);
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('The bill has been marked as Paid and saved!');
                loadTable(); // Reload the table to reflect the updated status
                closePopup('receipt');
            }
        };
    });
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
function confirmDelete(roomNum) {
    // Display the confirmation dialog
    let confirmation = confirm("Are you sure you want to delete the tenant in Room " + roomNum + "?");

    // If the user clicks "Yes", proceed with the deletion
    if (confirmation) {
        // Here you would send the request to your server to delete the tenant
        window.location.href = "delete_tenant.php?room_num=" + roomNum;
    }
}

// Function to mark a bill as paid and handle the response
function markBillAsPaid(roomNumber, billType, paymentDate, tenantName) {
    if (paymentDate === "") {
        alert("Please select a payment date.");
        return;
    }

    // Send payment data to save_payment.php via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "save_payment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Log to confirm values
    console.log('Room:', roomNumber, 'Bill Type:', billType, 'Payment Date:', paymentDate, 'Tenant:', tenantName);

    // Send fetch request to update the bill status
    fetch('update_bill_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            room_number: roomNumber,
            bill_type: billType,
            payment_date: paymentDate, // Full date
            tenant_name: tenantName
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Bill marked as paid successfully!');
            // Update the monthly report UI immediately after marking the bill as paid
            updateMonthlyReport(); // Refresh the report to reflect the new status
        } else {
            alert('Error marking the bill as paid: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



function updateMonthlyReport() {
    // Get the room number to find the corresponding report entry
    const roomNumber = document.getElementById('receipt-room').innerText;

    // Retrieve the current stored data (if using localStorage)
    let bills = JSON.parse(localStorage.getItem('bills')) || {};

    // Check if the room exists and update the report UI accordingly
    if (bills[roomNumber]) {
        const electricityStatus = document.getElementById('electricity-status-' + roomNumber);
        const waterStatus = document.getElementById('water-status-' + roomNumber);
        const rentalStatus = document.getElementById('rental-status-' + roomNumber);

        // Update electricity status if element exists
        if (electricityStatus && bills[roomNumber].electricityPaid) {
            electricityStatus.innerText = 'Paid';
        }

        // Update water status if element exists
        if (waterStatus && bills[roomNumber].waterPaid) {
            waterStatus.innerText = 'Paid';
        }

        // Update rental status if element exists
        if (rentalStatus && bills[roomNumber].rentalPaid) {
            rentalStatus.innerText = 'Paid';
        }
    } else {
        console.warn('Room number ' + roomNumber + ' not found in bills data');
    }
}


