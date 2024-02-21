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
<div class="dashboard-container">
  <div class="card">
      <h2>Всього кандидатів</h2>
      <p id="total-clients">0</p>
  </div>

  <div class="card">
      <h2>Кандидатів цього місяця</h2>
      <p id="clients-this-month">0</p>
      <span id="arrow"></span>
  </div>

  <div class="card">
      <h2>Останні 10 клієнтів</h2>
      <table id="last-clients-table">
          <!-- Table data will be dynamically populated here -->
      </table>
  </div>

  <div class="chart-card">
      <h2>Проекти</h2>
      <canvas id="projects-chart"></canvas>
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