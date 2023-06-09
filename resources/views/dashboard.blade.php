@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            Read the details, changelog and future development for this system &nbsp;
            <a href="{{route('changelog')}}" class="btn btn-info">More details here<div class="ripple-container"></div></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">cloud_queue</i>
              </div>
              <p class="card-category">Active</p>
              <h3 class="card-title">{{count($active_webspaces)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">local_offer</i> Maintained webspaces
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">visibility_off</i>
              </div>
              <p class="card-category">Inactive</p>
              <h3 class="card-title">{{count($inactive_webspaces)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">date_range</i> Unmaintained webspaces
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">priority_high</i>
              </div>
              <p class="card-category">Disabled</p>
              <h3 class="card-title">{{count($disabled_webspaces)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">update</i> Abandoned or a Security Risk
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">cloud_off</i>
              </div>
              <p class="card-category">Deleted</p>
              <h3 class="card-title">{{count($deleted_webspaces)}}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">view_headline</i> Discontinued webspaces
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="webspacesPerPlatform"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Platforms</h4>
              <p class="card-category">Statistics for online websites</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated every page refresh
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="webspacesPerMonth"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Webspace</h4>
              <p class="card-category">Created per month</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated every page refresh
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-primary">
              <div class="ct-chart" id="webspacesSupport"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Support</h4>
              <p class="card-category">Offered by the team</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated every page refresh
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">New Updates:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">cloud</i> Webspace
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">cloud</i> Platform and Version
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                    <tbody>
                      @php $i = 0; @endphp
                      @foreach ($the_webspaces->take(5) as $webspace)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{$webspace->name}}</td>
                        <td class="td-actions text-right">
                          @hasanyrole("super-admin|admin|editor")
                            <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" href="{{route('webspace.edit',['id' => $webspace->id])}}">
                              <i class="material-icons">edit</i>
                            </a>
                          @endhasanyrole
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <thead>
                      <th>ID</th>
                      <th>Name</th>
                      <th># of Webspaces</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @php $i = 0; @endphp
                      @foreach($platforms->take(5) as $platform)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$platform->name . " " . $platform->version }}</td>
                          <td>{{$platform->websites->count()}}</td>
                          <td class="td-actions text-right">
                            @hasanyrole("super-admin|admin|editor")
                              <a rel="tooltip" title="Edit" class="btn btn-primary btn-link btn-sm" href="{{route('platform.edit',['id' => $platform->id])}}">
                                <i class="material-icons">edit</i>
                              </a>
                            @endhasanyrole
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">System Records</h4>
              <p class="card-category">Total records for each objects in the system</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td>Total Webspaces</td>
                    <td>{{$the_webspaces->count()}}</td>
                    <td>
                      <a href="{{route('webspace.list')}}">
                        <i class="material-icons">visibility</i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>Total Active Websites</td>
                    <td>{{$websitesFromActiveWebspace->count()}}</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Total Owners</td>
                    <td>{{$owners->count()}}</td>
                    <td>
                      <a href="{{route('owner.list')}}">
                        <i class="material-icons">visibility</i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>Total Platform</td>
                    <td>{{$platforms->count()}}</td>
                    <td>
                      <a href="{{route('platform.list')}}">
                        <i class="material-icons">visibility</i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>Total Department</td>
                    <td>{{$departments->count()}}</td>
                    <td>
                      <a href="{{route('department.list')}}">
                        <i class="material-icons">visibility</i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });

    // platform
    $.get("{{route('dashboard.platform')}}", function(response){
      var sum = function(a, b) { return a + b };
      // adding percentage in label
      for( var i = 0; i < response.name.length; i++){
        var percent = Math.round(response.count[i] / response.count.reduce(sum) * 100) + '%';
        response.name[i] = response.name[i] + "("+percent+")"
      }

      var data  = {
        labels: response.name,
        series: [
          response.count
        ]
      }
      var options = {
        seriesBarDistance: 10,
        reverseData: true,
        horizontalBars: true,
        axisY: {
          offset: 120
        }
      };
      var platform_chart = new Chartist.Bar('#webspacesPerPlatform', data,options);

    });

    // webspace created
    $.get("{{route('dashboard.webspace-created')}}", function(response){
      dataWebspacesPerMonth = {
        labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
        series: [response]
      };
      optionsWebspacePerMonthChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 80, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      }

      var webspacePerMonthChart = new Chartist.Line('#webspacesPerMonth', dataWebspacesPerMonth, optionsWebspacePerMonthChart);

      // start animation for the Completed Tasks Chart - Line Chart
      md.startAnimationForLineChart(webspacePerMonthChart);
    });

    // support level
    $.get("{{route('dashboard.support')}}", function(response){
      var count = new Array();
      var name = new Array();

      $.each(response, function(index, value){
        count.push(value)
        name.push(index)
      });

      for( var i = 0; i < name.length; i++){
        name[i] = name[i] + "("+count[i]+")"
      }

      var data = {
        series: count,
        labels: name,
      }

      var options = {
        labelInterpolationFnc: function(value) {
          return value[0];
        },
        donut: true,
        donutWidth: 20,
        donutSolid: true,
        startAngle: 270,
        showLabel: true
      };

      var responsiveOptions = [
        ['screen and (min-width: 640px)', {
          chartPadding: 30,
          labelOffset: 100,
          labelDirection: 'explode',
          labelInterpolationFnc: function(value) {
            return value;
          }
        }],
        ['screen and (min-width: 1024px)', {
          labelOffset: 20,
          chartPadding: 20
        }]
      ];

      var platform_chart = new Chartist.Pie('#webspacesSupport', data, options, responsiveOptions);

    });

  </script>
@endpush