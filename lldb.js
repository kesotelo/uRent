document.addEventListener('DOMContentLoaded', () => {
    loadTable(); // Load the table initially
});

function loadTable() {
    const table = document.getElementById('bills-table');
    const month = document.getElementById('month-select') ? document.getElementById('month-select').value : 'June';
    const year = document.getElementById('year-select') ? document.getElementById('year-select').value : new Date().getFullYear().toString();

    // Fetch tenant data from the backend
    fetch('fetch_tenants.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch tenant data');
            }
            return response.json();
        })
        .then(tenants => {
            // Fetch bill data for the selected month/year
            getBillsData(year, month)
                .then(billsData => {
                    // Build the table header
                    table.innerHTML = `
                        <tr>
                            <th colspan="4">Year: ${year} Month: ${month} Bills Overview</th>
                        </tr>
                        <tr>
                            <th>Tenant (Room)</th>
                            <th>Electricity Bill Status</th>
                            <th>Water Bill Status</th>
                            <th>Rental Bills</th>
                        </tr>
                    `;

                    // Populate table rows with tenants and bills
                    tenants.forEach(tenant => {
                        const tenantBill = billsData.find(bill => bill.tenant === `Room ${tenant.room_num}`);
                        table.innerHTML += `
                            <tr>
                                <td>${tenant.username} (Room ${tenant.room_num})</td>
                                <td class="${tenantBill && tenantBill.electricityPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.electricityPaid ? 'Paid' : 'Not Paid'}</td>
                                <td class="${tenantBill && tenantBill.waterPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.waterPaid ? 'Paid' : 'Not Paid'}</td>
                                <td class="${tenantBill && tenantBill.rentPaid ? 'paid' : 'not-paid'}">${tenantBill && tenantBill.rentPaid ? 'Paid' : 'Not Paid'}</td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    console.error('Error fetching bills data:', error);
                    table.innerHTML = '<tr><td colspan="4">Error loading bills data.</td></tr>';
                });
        })
        .catch(error => {
            console.error('Error fetching tenant data:', error);
            table.innerHTML = '<tr><td colspan="4">Error loading tenant data.</td></tr>';
        });
}

function getBillsData(year, month) {
    return fetch(`fetch_bills.php?year=${year}&month=${month}`)
        .then(response => response.json())
        .catch(error => {
            console.error('Error fetching bill data:', error);
            return [];
        });
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
