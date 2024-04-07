@extends('layouts.app')
  
@section('title', 'Крута ЦРМка')
  
@section('contents')
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.dashboard-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    margin: 20px;
}

.card {
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 10px;
    border-radius: 8px;
    text-align: center;
}

.card h2 {
    color: #3498db; /* Blue color */
}

.card p {
    color: #2c3e50; /* Dark gray color */
    font-size: 24px;
}

#arrow {
    font-size: 30px;
}

.table-card {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    overflow-x: auto;
}

#last-clients-table {
    width: 100%;
    border-collapse: collapse;
}

#last-clients-table th, #last-clients-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

#last-clients-table th {
    background-color: #3498db; /* Blue color */
    color: #fff; /* White color */
}

.chart-card {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    margin: 10px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border-radius: 8px;
}
</style>

<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Earnings (Monthly)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Earnings (Annual)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', function () {
  // Fetch data from Laravel backend (use AJAX or Laravel Livewire)

  // Example data (replace with actual data)
  const totalClients = 100;
  const clientsThisMonth = 20;
  const lastClients = [
      { title: 'Кандидат 1', manager: 'Міша' },
      { title: 'Кандидат 2', manager: 'Оля' },
      // Add more client objects
  ];
  const projectsData = {
      labels: ['Проект 1', 'Проект 2', 'Проект 3'],
      data: [30, 50, 20],
  };

  // Update values on the dashboard
  document.getElementById('total-clients').innerText = totalClients;
  document.getElementById('clients-this-month').innerText = clientsThisMonth;

  // Display arrow based on the comparison of clients this month
  const arrowElement = document.getElementById('arrow');
  arrowElement.innerText = clientsThisMonth > 0 ? '↑' : '↓';

  // Populate last clients table
  const lastClientsTable = document.getElementById('last-clients-table');
  lastClients.forEach(client => {
      const row = lastClientsTable.insertRow();
      row.insertCell(0).innerText = client.title;
      row.insertCell(1).innerText = client.manager;
  });

  // Draw projects chart
  const projectsChartCanvas = document.getElementById('projects-chart');
  const projectsChartCtx = projectsChartCanvas.getContext('2d');
  new Chart(projectsChartCtx, {
      type: 'doughnut',
      data: {
          labels: projectsData.labels,
          datasets: [{
              data: projectsData.data,
              backgroundColor: ['#36a2eb', '#ff6384', '#4bc0c0'],
          }],
      },
  });
});
</script>
@endsection