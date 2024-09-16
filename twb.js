document.addEventListener('DOMContentLoaded', function () {
    // Dropdown functionality
    const setupDropdown = () => {
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdown = document.querySelector('.dropdown');

        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            dropdown.classList.toggle('open'); // Toggle the 'open' class to show/hide menu
        });
    };

    // Fetch real bill data from the server
    const fetchBillData = async () => {
        try {
            const response = await fetch('getBills.php'); // Fetch data from PHP
            const data = await response.json(); // Parse the JSON response
            return data;
        } catch (error) {
            console.error('Error fetching bill data:', error);
            return null;
        }
    };

    // Function to set bill amounts in the UI
    const setBillAmounts = (bill) => {
        document.querySelector('.previous-bill p').textContent = `$${bill.previous_bill}`;
        document.querySelector('.current-bill p').textContent = `$${bill.current_bill}`;
    };

    // Function to set payment date to match due date
    const setPaymentDate = (bill) => {
        document.querySelector('.payment-date').textContent = `Date of Payment: ${bill.due_date}`;
    };

    // Print functionality
    const setupPrintButton = () => {
        const printButtons = document.querySelectorAll('.print-btn');
        printButtons.forEach(button => {
            button.addEventListener('click', function () {
                window.print();
            });
        });
    };

    // View Button functionality
    const setupViewButton = () => {
        const viewButton = document.getElementById('viewButton');
        const popupContainer = document.getElementById('popup-container');
        const closeButton = document.querySelector('.close-btn');

        // Show the popup when 'View' button is clicked
        viewButton.addEventListener('click', function () {
            popupContainer.style.display = 'flex';
        });

        // Hide the popup when 'close-btn' is clicked
        closeButton.addEventListener('click', function () {
            popupContainer.style.display = 'none';
        });

        // Hide the popup when user clicks outside the popup content
        window.addEventListener('click', function (event) {
            if (event.target === popupContainer) {
                popupContainer.style.display = 'none';
            }
        });
    };

    // Main execution
    const main = async () => {
        setupDropdown(); // Set up dropdown functionality

        const bills = await fetchBillData(); // Fetch bill data from server

        if (bills && bills.length > 0) {
            const waterBill = bills.find(bill => bill.bill_type === 'water'); // Example for water bill
            if (waterBill) {
                setBillAmounts(waterBill); // Set the actual bill amounts
                setPaymentDate(waterBill); // Set payment date to due date
            }
        } else {
            console.error('No bill data available.');
        }

        setupPrintButton(); // Set up print functionality
        setupViewButton();  // Set up view button functionality
    };

    main(); // Call the main function to execute the flow
});
