@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')
{{-- <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script> --}}
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Helpdesk Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Requests Last Week</h3>
                    </div>
                  </div>
                  <div class="card-body">
             
                    <div class="position-relative mb-4"><div id="visitors-chart"></div></div>
                    <div class="d-flex flex-row justify-content-end">
                      <span class="me-2">
                        <i class="bi bi-square-fill text-primary"></i> Inbound
                      </span>
                      <span><i class="bi bi-square-fill text-secondary"></i> Complete</span>
                    </div>
                  </div>
                </div>
                
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Open Requests by Mode</h3>
                    <div class="card-tools">
                      {{-- <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i> </a>
                      <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a> --}}
                    </div>
                  </div>
                  

                  <div id="user-status-chart" class="d-flex justify-content-center"></div> <!-- Center the pie chart -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col-md-6 -->
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">SLA Violation by Technician</h3>
                      {{-- <a
                        href="javascript:void(0);"
                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                      >View Report</a
                      > --}}
                    </div>
                  </div>
                  <div class="card-body">
                
                    <div class="position-relative mb-4"><div id="orgmonChart"></div></div>
                    
                  </div>
                </div>
                
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Top Organizations by User Count</h3>
                  </div>
                  <div class="card-body">
                    <div id="orgChart"></div> <!-- Placeholder for ApexCharts -->
                  </div>
      
              </div>
              <!-- /.col-md-6 -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->

      <!--end::Footer-->



      <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

 <script src="{{ asset('assets/dist/js/ticketsPriorityData.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/dist/js/avgTimeData.js') }}"></script>




    {{-- <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script> --}}
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    {{-- <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script> --}}
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <script>

      const visitors_chart_options = {
        series: [
          {
            name: 'High - 2023',
            data: [100, 120, 170, 167, 180, 177, 160],
          },
          {
            name: 'Low - 2023',
            data: [60, 80, 70, 67, 80, 77, 100],
          },
        ],
        chart: {
          height: 200,
          type: 'line',
          toolbar: {
            show: false,
          },
        },
        colors: ['#0d6efd', '#adb5bd'],
        stroke: {
          curve: 'smooth',
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
        },
        legend: {
          show: false,
        },
        markers: {
          size: 1,
        },
        xaxis: {
          categories: ['22th', '23th', '24th', '25th', '26th', '27th', '28th'],
        },
      };

      const visitors_chart = new ApexCharts(
        document.querySelector('#visitors-chart'),
        visitors_chart_options,
      );
      visitors_chart.render();

      const sales_chart_options = {
        series: [
          {
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          },
          {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          },
          {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
          },
        ],
        chart: {
          type: 'bar',
          height: 200,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent'],
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return '$ ' + val + ' thousands';
            },
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#sales-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
     <script id="rendered-js">
      Highcharts.chart('containerchart', {
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: {
            week: '%e of %b' } },
      
      
      
        series: [{
          data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 330, 222, 338, 42, 33, 48, 193, 282, 118],
          pointStart: Date.UTC(2019, 0, 7),
          pointInterval: 24 * 3600 * 1000 * 7 // one week
        }] });
      //# sourceURL=pen.js
          </script>

<script>
  // Fetch the data from the route
  fetch("{{ route('getTopGorg') }}")
    .then(response => response.json())
    .then(data => {
      // Prepare the chart options for ApexCharts
      const chartOptions = {
        series: [{
          name: 'User Count',
          data: data.counts
        }],
        chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '50%'
          }
        },
        dataLabels: {
          enabled: false
        },
        colors: ['#0d6efd'],  // Customize colors
        xaxis: {
          categories: data.organizations,
          title: {
            text: 'Organizations'
          }
        },
        yaxis: {
          title: {
            text: 'User Count'
          },
          min: 0
        },
        title: {
          text: 'Top Organizations by User Count',
          align: 'center'
        }
      };

      // Create the chart
      const chart = new ApexCharts(document.querySelector("#orgChart"), chartOptions);
      chart.render();  // Render the chart to the page
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetchOrgChartData();
  });

  function fetchOrgChartData() {
    fetch('{{ route('orgpermonth') }}')
      .then(response => response.json())
      .then(data => {
        renderOrgChart(data.months, data.organizations);
      })
      .catch(error => {
        console.error('Error fetching org chart data:', error);
      });
  }

  function renderOrgChart(months, organizations) {
    const options = {
      chart: {
        type: 'bar',
        height: 300
      },
      series: [{
        name: 'Organizations',
        data: organizations
      }],
      xaxis: {
        categories: months
      },
      colors: ['#0d6efd']
    };

    const chart = new ApexCharts(document.querySelector("#orgmonChart"), options);
    chart.render();
  }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('getOrganizationsUserStatus') }}")
      .then(response => response.json())
      .then(data => {
        // Ensure data is properly structured and accessible
        if(data && data.created_users_count !== undefined && data.not_created_users_count !== undefined) {
          const chartOptions = {
            series: [data.created_users_count, data.not_created_users_count],  // Use the correct keys
            chart: {
              type: 'pie',
              height: 300
            },
            labels: ['Created Users', 'No Users'],
            colors: ['#0d6efd', '#adb5bd'],
            title: {
              text: 'Organizations with/without Users',
              align: 'center'
            }
          };

          const chart = new ApexCharts(document.querySelector("#user-status-chart"), chartOptions);
          chart.render();
        } else {
          console.error("Invalid data structure:", data);
        }
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  });
</script>



@endsection
