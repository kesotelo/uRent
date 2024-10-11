document.addEventListener('DOMContentLoaded', () => {
    loadTable(); // Load the table initially
    document.getElementById('year-select').addEventListener('change', loadTable);
    document.getElementById('month-select').addEventListener('change', loadTable);
});

function updateMonthlyReport() {
    // Reload the bills table for the selected month and year
    loadTable();
}

function loadTable() {
    const table = document.getElementById('bills-table');
    const month = document.getElementById('month-select').value;
    const year = document.getElementById('year-select').value;

    fetch('fetch_tenants.php')
        .then(response => response.json())
        .then(tenants => {
            getBillsData(year, month)
                .then(billsData => {
                    table.innerHTML += `
                    <tr>
                        <td>Room ${tenant.room_num}</td>
                        <td>${tenant.username}</td>
                        <td class="${tenantBill && tenantBill.electricityPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.electricityPaid ? 'Paid' : 'Not Paid'}</td>
                        <td class="${tenantBill && tenantBill.waterPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.waterPaid ? 'Paid' : 'Not Paid'}</td>
                        <td class="${tenantBill && tenantBill.rentalPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.rentalPaid ? 'Paid' : 'Not Paid'}</td>
                    </tr>
                `;
                

                    tenants.forEach(tenant => {
                        const tenantBill = billsData.find(bill => bill.tenant === `Room ${tenant.room_num}`);
                        table.innerHTML += `
                            <tr>
                                <td>Room ${tenant.room_num}</td>
                                <td>${tenant.username}</td>
                                <td class="${tenantBill && tenantBill.electricityPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.electricityPaid ? 'Paid' : 'Not Paid'}</td>
                                <td class="${tenantBill && tenantBill.waterPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.waterPaid ? 'Paid' : 'Not Paid'}</td>
                                <td class="${tenantBill && tenantBill.rentalPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.rentalPaid ? 'Paid' : 'Not Paid'}</td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    console.error('Error fetching bills data:', error);
                    table.innerHTML = '<tr><td colspan="5">Error loading bills data.</td></tr>';
                });
        })
        .catch(error => {
            console.error('Error fetching tenant data:', error);
            table.innerHTML = '<tr><td colspan="5">Error loading tenant data.</td></tr>';
        });
}


// Function to fetch bills data for a specific year and month
function getBillsData(year, month) {
    return fetch(`fetch_bills.php?year=${year}&month=${month}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch bills data');
            }
            return response.json();
        })
        .catch(error => console.error('Error fetching bills data:', error));
}



function loadTransactionReport() {
    const tableBody = document.querySelector("#report-table tbody");
    tableBody.innerHTML = '';

    // Fetch data from the server
    fetch('fetch_transactions.php')
        .then(response => response.json())
        .then(transactions => {
            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${transaction.room_number}</td>
                    <td>${transaction.tenant_name}</td>
                    <td>${transaction.bill_type}</td>
                    <td>${transaction.amount_paid}</td>
                    <td>${transaction.date_paid}</td>
                    <td>
                        <a href="uploads/${transaction.proof_of_payment}" target="_blank">
                            View PDF
                        </a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching transactions:', error);
        });
}


 // Dropdown Toggle Functionality
 document.querySelectorAll('.dropdown-toggleSide').forEach(item => {
    item.addEventListener('click', function() {
        const dropdownMenu = this.nextElementSibling;
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
});

// Handle sidebar dropdown item clicks
document.querySelectorAll('.dropdown-itemSide').forEach(function(item) {
    item.addEventListener('click', function() {
        var action = this.getAttribute('data-action');

        // Hide both sections first
        document.getElementById('bills-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';

        // Show the selected section and load the data
        if (action === 'monthly_report') {
            document.getElementById('bills-section').style.display = 'block';
            loadTable();  // Load the bills data
        } else if (action === 'transaction_report') {
            document.getElementById('report-section').style.display = 'block';
            loadTransactionReport();  // Load the transaction report data
        }
    });
});

document.getElementById('bills-section').style.display = 'block'; // Ensure visibility when loading tenant data

