
const electricityUsageCtx = document.getElementById('electricityUsageChart').getContext('2d');
const waterUsageCtx = document.getElementById('waterUsageChart').getContext('2d');
const utilitiesCostCtx = document.getElementById('utilitiesCostChart').getContext('2d');
const estimatedChangeCtx = document.getElementById('estimatedChangeChart').getContext('2d');


const electricityUsageChart = new Chart(electricityUsageCtx, {
    type: 'line',
    data: {
        labels: [], 
        datasets: [{
            label: 'Electricity Usage',
            data: [], 
            borderColor: '#3b82f6',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            x: { display: false }, 
            y: { display: false }  
        }
    }
});

const waterUsageChart = new Chart(waterUsageCtx, {
    type: 'line',
    data: {
        labels: [], 
        datasets: [{
            label: 'Water Usage',
            data: [], 
            borderColor: '#3b82f6',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            x: { display: false }, 
            y: { display: false }  
        }
    }
});

const utilitiesCostChart = new Chart(utilitiesCostCtx, {
    type: 'pie',
    data: {
        labels: [], 
        datasets: [{
            label: 'Utilities Cost',
            data: [], 
            backgroundColor: ['#3b82f6', '#ef4444'],
            borderWidth: 2
        }]
    },
    options: {}
});

const estimatedChangeChart = new Chart(estimatedChangeCtx, {
    type: 'bar',
    data: {
        labels: [], 
        datasets: [{
            label: 'Estimated Change in Cost',
            data: [], 
            backgroundColor: '#3b82f6',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            x: { display: false }, 
            y: { display: false }  
        }
    }
});
