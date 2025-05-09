@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Helpdesk Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Requests Last Week Card -->
                        <div class="card mb-4">
                          <div class="card-header border-0">
                              <div class="d-flex justify-content-between">
                                  <h3 class="card-title">Tickets This Year (Monthly Count)</h3>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="position-relative mb-4">
                                  <div id="monthly-tickets-chart" style="height: 300px;"></div>
                              </div>
                          </div>
                      </div>
                      

                        <!-- Open Requests by Mode Card -->
                        <div class="card mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">Open Requests by Mode</h3>
                            </div>
                            <div class="card-body">
                                <div id="open-requests-chart"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <!-- User Role Data Card -->
                        <div class="card mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">User Role Data</h3>
                            </div>
                            <div class="card-body">
                                <div id="role-chart"></div>
                            </div>
                        </div>

                        <!-- Request Complete Card -->
                        <div class="card mb-4">
                            <div class="card-header border-0">
                                <h3 class="card-title">Request Complete in Last Week</h3>
                            </div>
                            <div id="completed-requests-weekly" style="height: 300px;"></div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('assets/dist/js/ticketsPriorityData.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/dist/js/avgTimeData.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{ route('getOpenRequests') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var options = {
                        series: [data.L1, data.L2, data.L3],
                        chart: {
                            type: 'donut',
                            height: 300
                        },
                        labels: ['L1', 'L2', 'L3'],
                        colors: ['#E87609', '#343a40', '#adb5bd']
                    };
                    var chart = new ApexCharts(document.querySelector("#open-requests-chart"), options);
                    chart.render();
                },
                error: function () {
                    console.log("Error fetching data.");
                }
            });
        });

        const visitors_chart_options = {
            series: [
                { name: 'High - 2023', data: [100, 120, 170, 167, 180, 177, 160] },
                { name: 'Low - 2023', data: [60, 80, 70, 67, 80, 77, 100] },
            ],
            chart: {
                height: 200,
                type: 'line',
                toolbar: { show: false }
            },
            colors: ['#0d6efd', '#adb5bd'],
            stroke: { curve: 'smooth' },
            grid: {
                borderColor: '#e7e7e7',
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5,
                }
            },
            legend: { show: false },
            markers: { size: 1 },
            xaxis: {
                categories: ['22th', '23th', '24th', '25th', '26th', '27th', '28th'],
            },
        };

        const visitors_chart = new ApexCharts(
            document.querySelector('#visitors-chart'),
            visitors_chart_options
        );
        visitors_chart.render();

        $(document).ready(function () {
            $.ajax({
                url: "{{ route('getUserRoleData') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    renderUserRoleChart(data.months, data.user, data.engineer, data.support);
                },
                error: function () {
                    console.log("Error fetching user role data.");
                }
            });
        });

        function renderUserRoleChart(months, userCounts, engineerCounts, supportCounts) {
            var options = {
                series: [
                    { name: 'User', data: userCounts },
                    { name: 'Engineer', data: engineerCounts },
                    { name: 'Support Team', data: supportCounts }
                ],
                chart: {
                    type: 'bar',
                    height: 250
                },
                stroke: { curve: 'smooth' },
                title: {
                    text: 'User Role Data (Last 12 Months)',
                    align: 'center'
                },
                xaxis: { categories: months },
                colors: ['#0d6efd', '#20c997', '#ffc107']
            };
            var chart = new ApexCharts(document.querySelector("#role-chart"), options);
            chart.render();
        }

        const sales_chart = new ApexCharts(
            document.querySelector('#sales-chart'),
            sales_chart_options
        );
        sales_chart.render();
    </script>
    <script>
      $(document).ready(function () {
          $.ajax({
              url: "{{ route('getCompletedTicketsWeekly') }}",
              type: "GET",
              dataType: "json",
              success: function (data) {
                  renderCompletedRequestsChart(data.days, data.counts);
              },
              error: function () {
                  console.log("Error fetching weekly completed ticket data.");
              }
          });
      });
  
      function renderCompletedRequestsChart(days, counts) {
          var options = {
              series: [{
                  name: 'Completed Tickets',
                  data: counts
              }],
              chart: {
                  type: 'bar',
                  height: 300
              },
              title: {
                  text: 'Completed Requests by Day (Last Week)',
                  align: 'center'
              },
              xaxis: {
                  categories: days
              },
              colors: ['#198754']
          };
  
          var chart = new ApexCharts(document.querySelector("#completed-requests-weekly"), options);
          chart.render();
      }
  </script>

  <script>
    // Chart: Monthly Tickets
$.ajax({
    url: "{{ route('getMonthlyTicketsCount') }}",
    type: "GET",
    dataType: "json",
    success: function (response) {
        const months = response.map(item => item.month);
        const counts = response.map(item => item.count);

        const chartOptions = {
            series: [{
                name: 'Tickets',
                data: counts
            }],
            chart: {
                type: 'bar',
                height: 300
            },
            // title: {
            //     text: 'Tickets Raised per Month (Current Year)',
            //     align: 'left'
            // },
            xaxis: {
                categories: months
            },
            colors: ['#0d6efd']
        };

        new ApexCharts(document.querySelector("#monthly-tickets-chart"), chartOptions).render();
    },
    error: function () {
        console.error("Failed to load monthly ticket data.");
    }
});

  </script>
  
@endsection
