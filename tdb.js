document.addEventListener('DOMContentLoaded', async function () {
    // Fetch or simulate data
    const fetchData = async () => {
        return {
            monthlyBills: await getMonthlyBillsData(), // Fetch or generate monthly bills data
            dailyBills: await getDailyBillsData(),     // Fetch or generate daily bills data
            dueDates: generateDueDates(),              // Generate or fetch due dates
        };
    };

    // Fetch or simulate Monthly Bills Data
    const getMonthlyBillsData = async () => {
        // Replace this with actual data fetching logic (e.g., API calls)
        return {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [
                { 
                    label: 'Electricity', 
                    data: [], 
                    backgroundColor: '#4e73df' 
                },
                { 
                    label: 'Water', 
                    data: [], 
                    backgroundColor: '#36b9cc' 
                },
                { 
                    label: 'Rental', 
                    data: [], 
                    backgroundColor: '#1cc88a' 
                },
            ],
        };
    };

    // Fetch or simulate Daily Bills Data
    const getDailyBillsData = async () => {
        // Replace this with actual data fetching logic (e.g., API calls)
        return {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [
                { 
                    label: 'Bills', 
                    data: [], 
                    backgroundColor: '#4e73df', 
                    borderColor: '#4e73df', 
                    fill: false, 
                    tension: 0.4 
                },
            ],
        };
    };

    // Generate Due Dates (Dynamic)
    const generateDueDates = () => {
        const dueDates = [];
        for (let i = 0; i < 6; i++) {
            let date = new Date();
            date.setMonth(date.getMonth() + i);
            // Ensure the 20th exists in all months (handle February)
            let day = 20;
            let month = date.getMonth();
            let year = date.getFullYear();
            // Adjust day if necessary
            if ((month === 1 && day > 28) || (day > new Date(year, month + 1, 0).getDate())) {
                day = new Date(year, month + 1, 0).getDate(); // Last day of the month
            }
            dueDates.push(`${date.toLocaleString('default', { month: 'long' })} ${day}, ${year}`);
        }
        return {
            electricity: dueDates,
            water: dueDates,
            rental: dueDates,
        };
    };

    // Initialize Charts
    const initializeCharts = (data) => {
        // Create a reusable chart creation function
        const createChart = (ctx, type, data, options) => {
            return new Chart(ctx, {
                type: type,
                data: data,
                options: options,
            });
        };

        // Monthly Bills Chart
        createChart(document.getElementById('monthlyBillsChart').getContext('2d'), 'bar', data.monthlyBills, {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'Monthly Bills',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Amount',
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month',
                    },
                },
            },
        });

        // Daily Bills Charts
        const dailyChartIds = [
            { id: 'electricityDailyChart', label: 'Electricity Bills' },
            { id: 'waterDailyChart', label: 'Water Bills' },
            { id: 'rentalDailyChart', label: 'Rental Bills' },
        ];

        dailyChartIds.forEach(chartInfo => {
            createChart(document.getElementById(chartInfo.id).getContext('2d'), 'line', data.dailyBills, {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                        text: chartInfo.label,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount ',
                        },
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day',
                        },
                    },
                },
            });
        });
    };

    // Render Due Dates
    const renderDueDates = (dueDates) => {
        const dueDatesContainer = document.querySelector('.due-dates');
        dueDatesContainer.innerHTML = `
            <div class="due-date-item">
                <h3>Electricity Bills</h3>
                ${dueDates.electricity.map(date => `<p>${date}</p>`).join('')}
            </div>
            <div class="due-date-item">
                <h3>Water Bills</h3>
                ${dueDates.water.map(date => `<p>${date}</p>`).join('')}
            </div>
            <div class="due-date-item">
                <h3>Rental Bills</h3>
                ${dueDates.rental.map(date => `<p>${date}</p>`).join('')}
            </div>
        `;
    };

    // Main Execution
    try {
        const data = await fetchData();
        initializeCharts(data);
        renderDueDates(data.dueDates);
    } catch (error) {
        console.error('Error initializing dashboard:', error);
        // Optionally, display an error message to the user
    }
});

// Add active class to the current link
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.sidebar ul li a');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
});

// Dropdown Toggle Logic for sidebar
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdownSide');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggleSide');
        
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            dropdown.classList.toggle('open');
        });
    });

    // Optional: Close dropdown if clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdownSide')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('open');
            });
        }
    });
});
