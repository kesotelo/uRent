document.addEventListener('DOMContentLoaded', () => {
    loadTable(); 
});

function loadTable() {
    const table = document.getElementById('bills-table');
    const month = document.getElementById('month-select') ? document.getElementById('month-select').value : 'June';
    const year = document.getElementById('year-select') ? document.getElementById('year-select').value : new Date().getFullYear().toString();

    // Dropdown for selecting the month
    const monthSelect = `
        <select id="month-select" onchange="loadTable()">
            <option value="January" ${month === 'January' ? 'selected' : ''}>January</option>
            <option value="February" ${month === 'February' ? 'selected' : ''}>February</option>
            <option value="March" ${month === 'March' ? 'selected' : ''}>March</option>
            <option value="April" ${month === 'April' ? 'selected' : ''}>April</option>
            <option value="May" ${month === 'May' ? 'selected' : ''}>May</option>
            <option value="June" ${month === 'June' ? 'selected' : ''}>June</option>
            <option value="July" ${month === 'July' ? 'selected' : ''}>July</option>
            <option value="August" ${month === 'August' ? 'selected' : ''}>August</option>
            <option value="September" ${month === 'September' ? 'selected' : ''}>September</option>
            <option value="October" ${month === 'October' ? 'selected' : ''}>October</option>
            <option value="November" ${month === 'November' ? 'selected' : ''}>November</option>
            <option value="December" ${month === 'December' ? 'selected' : ''}>December</option>
        </select>
    `;

    // Dropdown for selecting the year
    const yearSelect = `
        <select id="year-select" onchange="loadTable()">
            <option value="2024" ${year === '2024' ? 'selected' : ''}>2024</option>
            <option value="2023" ${year === '2023' ? 'selected' : ''}>2023</option>
            <option value="2022" ${year === '2022' ? 'selected' : ''}>2022</option>
            <!-- Add more years as needed -->
        </select>
    `;

    // Fetch data for the selected year and month
    const billsData = getBillsData(year, month);

    // Build the table header with dropdowns
    table.innerHTML = `
        <tr>
            <th colspan="4">Year: ${yearSelect} Month: ${monthSelect} Bills Overview</th>
        </tr>
    `;

    if (billsData.length > 0) {
        // Build table headers
        table.innerHTML += `
            <tr>
                <th>Tenants</th>
                <th>Electricity Bill Status</th>
                <th>Water Bill Status</th>
                <th>Rental Bills</th>
            </tr>
        `;

        // Populate table rows
        billsData.forEach((row) => {
            table.innerHTML += `
                <tr>
                    <td>${row.tenant}</td>
                    <td class="${row.electricityPaid ? 'paid' : 'not-paid'}">${row.electricityPaid ? 'Paid' : 'Not Paid'}</td>
                    <td class="${row.waterPaid ? 'paid' : 'not-paid'}">${row.waterPaid ? 'Paid' : 'Not Paid'}</td>
                    <td class="${row.rentPaid ? 'paid' : 'not-paid'}">${row.rentPaid ? 'Paid' : 'Not Paid'}</td>
                </tr>
            `;
        });
    } else {
        // Display message when no data is available
        table.innerHTML += `
            <tr>
                <td colspan="4">No records available for ${month} ${year}.</td>
            </tr>
        `;
    }
}

function getBillsData(year, month) {
    // Simulated data for each year and month
    const bills = {
        2024: {
            January: [],
            February: [],
            March: [],
            April: [],
            May: [
                { tenant: 'Room 1', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 2', electricityPaid: false, waterPaid: true, rentPaid: true },
                { tenant: 'Room 3', electricityPaid: true, waterPaid: false, rentPaid: false },
                { tenant: 'Room 4', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 5', electricityPaid: false, waterPaid: true, rentPaid: true },
                { tenant: 'Room 6', electricityPaid: true, waterPaid: false, rentPaid: false },
            ],
            June: [
                { tenant: 'Room 1', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 2', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 3', electricityPaid: true, waterPaid: true, rentPaid: false },
                { tenant: 'Room 4', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 5', electricityPaid: false, waterPaid: true, rentPaid: true },
                { tenant: 'Room 6', electricityPaid: true, waterPaid: false, rentPaid: false },
            ],
            July: [],
            August: [],
            September: [],
            October: [],
            November: [],
            December: []
        },
        2023: {
            January: [],
            February: [],
            March: [],
            April: [],
            May: [],
            June: [
                { tenant: 'Room 1', electricityPaid: false, waterPaid: false, rentPaid: false },
                { tenant: 'Room 2', electricityPaid: true, waterPaid: false, rentPaid: true },
                { tenant: 'Room 3', electricityPaid: false, waterPaid: true, rentPaid: true },
                { tenant: 'Room 4', electricityPaid: true, waterPaid: true, rentPaid: true },
                { tenant: 'Room 5', electricityPaid: false, waterPaid: true, rentPaid: true },
                { tenant: 'Room 6', electricityPaid: true, waterPaid: false, rentPaid: false },
            ],
            July: [],
            August: [],
            September: [],
            October: [],
            November: [],
            December: []
        },
    };
    return bills[year] && bills[year][month] ? bills[year][month] : [];
}


function loadTransactionReport() {
    const tableBody = document.querySelector("#report-table tbody");
    tableBody.innerHTML = '';

    // Example data - Replace this with data fetched from the database
    const transactions = [
        {roomNumber: '', name: '', type: '', amount: 1200, date: '', proof: ''},
        {roomNumber: '', name: '', type: '', amount: 500, date: '', proof: ''},
        {roomNumber: '', name: '', type: '', amount: 5000, date: '', proof: ''},
        // Add more transactions here
    ];

    transactions.forEach(transaction => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${transaction.roomNumber}</td>
            <td>${transaction.name}</td>
            <td>${transaction.type}</td>
            <td>${transaction.amount}</td>
            <td>${transaction.date}</td>
            <td><img src="images/${transaction.proof}" alt="Proof of Payment" style="width: 100px; height: 100px;"></td>
        `;
        tableBody.appendChild(row);
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
