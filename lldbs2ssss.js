document.addEventListener('DOMContentLoaded', () => {
    loadTable(); 
    document.getElementById('yearSelect').addEventListener('change', updateTable);
    document.getElementById('monthSelect').addEventListener('change', updateTable);
});

function updateTable() {
    const month = document.getElementById("monthSelect").value;
    const year = document.getElementById("yearSelect").value;
    const tableBody = document.getElementById("tableBody");

    fetch(`get_monthly_data.php?month=${month}&year=${year}`)
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = "";
            data.forEach(tenant => {
                const row = document.createElement("tr");

                const nameCell = document.createElement("td");
                nameCell.textContent = tenant.tenant_name;

                const roomCell = document.createElement("td");
                roomCell.textContent = tenant.room_number;

                const electricityCell = createStatusCell(tenant, "electricity_status");
                const waterCell = createStatusCell(tenant, "water_status");
                const rentalCell = createStatusCell(tenant, "rental_status");

                row.appendChild(nameCell);
                row.appendChild(roomCell);
                row.appendChild(electricityCell);
                row.appendChild(waterCell);
                row.appendChild(rentalCell);

                tableBody.appendChild(row);
            });
        });
}

function createStatusCell(tenant, type) {
    const cell = document.createElement("td");
    const select = document.createElement("select");

    ["Not Paid", "Paid"].forEach(status => {
        const option = document.createElement("option");
        option.value = status;
        option.text = status;
        if (tenant[type] === status) {
            option.selected = true;
        }
        select.appendChild(option);
    });

    select.addEventListener("change", function () {
        const status = select.value;
        const tenantName = tenant.tenant_name;
        const roomNumber = tenant.room_number;
        const month = tenant.month;
        const year = tenant.year;

        fetch("update_statuss.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `tenant_name=${tenantName}&room_number=${roomNumber}&month=${month}&year=${year}&type=${type}&status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status !== "success") {
                alert("Error updating status: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });

    cell.appendChild(select);
    return cell;
}

// Load table data for the bills section
function loadTable() {
    updateTable(); // Calls updateTable to load data initially
}
