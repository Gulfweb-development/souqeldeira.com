<div>
    <x-slot name="meta_title">@lang('app.dashboard')</x-slot>
    <x-slot name="title">@lang('app.dashboard')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item active">@lang('app.dashboard')</li>
    </x-slot>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.ad.index') }}">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $approvedAds }}</h3>

                    <p>@lang('app.aproved_ads')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.ad.index') }}">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $penddingAds }}</h3>

                    <p>@lang('app.pendding_ads')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.user.index') }}">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $companyUsers }}</h3>

                    <p>@lang('app.company')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.user.index') }}">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $normalUsers }}</h3>

                    <p>@lang('app.users')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.user.index') }}">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $registeredUsers }}</h3>

                    <p>@lang('app.registered_user')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.governorate.index') }}">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $governorates }}</h3>

                    <p>@lang('app.governorates')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.region.index') }}">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $regions }}</h3>

                    <p>@lang('app.regions')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.faq.index') }}">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $faqs }}</h3>

                    <p>@lang('app.faqs')</p>
                </div>
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.invoices.index') }}">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_today }} @lang('app.currency')</h3>
                    <p>@lang('paid_today')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.invoices.index') }}">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_this_week }} @lang('app.currency')</h3>
                    <p>@lang('paid_this_week')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.invoices.index') }}">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_this_month }} @lang('app.currency')</h3>
                    <p>@lang('paid_this_month')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="{{ route('admin.invoices.index') }}">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $paid_last_month }} @lang('app.currency')</h3>
                    <p>@lang('paid_last_month')</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar-sign"></i>
                </div>
            </div>
            </a>
        </div>
        <!-- ./col -->
    </div>
    <div class="row mt-2">
        <div class="col-lg-12 col-12">
            <div class="small-box bg-with" style="background-color: white;">
                <div class="inner">
                    <table class="table-striped table-responsive table dataTable w-100" style="display: inline-table;">
                        <thead class="w-100" role="row">
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">show advertise in list</th>
                                <th class="text-center">click on advertise in list</th>
                                <th class="text-center">Impression</th>
                                <th class="text-center">click on Telephone</th>
                                <th class="text-center">click on Whatsapp</th>
                            </tr>
                        </thead>
                        <tbody class="w-100">
                            @foreach( $chart['day'] as $i => $day)
                                <tr>
                                    <th>{{ $day }}</th>
                                    <td class="text-center" title="Num. show advertise in list of Ads">{{ number_format($chart['advertise']['view'][$i]) }}</td>
                                    <td class="text-center" title="Num. click on advertise in list of Ads">{{ number_format($chart['advertise']['click'][$i]) }}</td>
                                    <td class="text-center" title="Impression of Click on Ads">{{ $chart['advertise']['impression'][$i]  }}%</td>
                                    <td class="text-center" title="Num. click on Telephone for All Ads">{{ number_format($chart['advertise']['telephone'][$i]) }}</td>
                                    <td class="text-center" title="Num. click on Whatsapp for All Ads">{{ number_format($chart['advertise']['whatsapp'][$i]) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12">
            <div class="small-box bg-with" style="background-color: white;">
                <div class="inner">
                    <table class="table-striped table-responsive table dataTable w-100" style="display: inline-table;">
                        <thead class="w-100" role="row">
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">show agency in list</th>
                            <th class="text-center">click on agency in list</th>
                            <th class="text-center">Impression</th>
                            <th class="text-center">click on Telephone</th>
                            <th class="text-center">click on Whatsapp</th>
                        </tr>
                        </thead>
                        <tbody class="w-100">
                        @foreach( $chart['day'] as $i => $day)
                            <tr>
                                <th>{{ $day }}</th>
                                <td class="text-center" title="Num. of show agency in list of agencies in site">{{ number_format($chart['agency']['view'][$i]) }}</td>
                                <td class="text-center" title="Num. of click on agency in list of agencies in site">{{ number_format($chart['agency']['click'][$i]) }}</td>
                                <td class="text-center" title="Impression of Click on Ads">{{ $chart['agency']['impression'][$i] }}%</td>
                                <td class="text-center" title="Num. of click on Telephone of agency">{{ number_format($chart['agency']['telephone'][$i]) }}</td>
                                <td class="text-center" title="Num. of click on Whatsapp of agency">{{ number_format($chart['agency']['whatsapp'][$i]) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-5">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-with" style="background-color: white;">
                <div class="inner">
                    <canvas class="w-100" id="map_ad"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-with" style="background-color: white;">
                <div class="inner">
                    <canvas class="w-100" id="map_agency"></canvas>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Define the data to be displayed on the chart
        const advertise = {
            labels: [
                '{!! implode("', '" , $chart['day'] )  !!}'
            ],
            datasets: [
                {
                    label: 'Num. of show advertise in list of ads in site',
                    data: [ {{ implode(", " , $chart['advertise']['view'] )  }} ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on advertise in list of ads in site',
                    data: [{{ implode(", " , $chart['advertise']['click'] )  }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on Telephone in advertise details',
                    data: [{{ implode(", " , $chart['advertise']['telephone'] )  }}],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on Whatsapp in advertise details',
                    data: [{{ implode(", " , $chart['advertise']['whatsapp'] )  }}],
                    backgroundColor: 'rgba(92,255,86,0.2)',
                    borderColor: 'rgb(86,255,94)',
                    borderWidth: 1
                }
            ]
        };
        // Define the data to be displayed on the chart
        const agency = {
            labels: [
                '{!! implode("', '" , $chart['day'] )  !!}'
            ],
            datasets: [
                {
                    label: 'Num. of show agency in list of agencies in site',
                    data: [ {{ implode(", " , $chart['agency']['view'] )  }} ],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on agency in list of agencies in site',
                    data: [{{ implode(", " , $chart['agency']['click'] )  }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on Telephone of agency',
                    data: [{{ implode(", " , $chart['agency']['telephone'] )  }}],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Num. of click on Whatsapp of agency',
                    data: [{{ implode(", " , $chart['agency']['whatsapp'] )  }}],
                    backgroundColor: 'rgba(92,255,86,0.2)',
                    borderColor: 'rgb(86,255,94)',
                    borderWidth: 1
                }
            ]
        };

        // Define the chart options
        const options = {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Create the chart
        const ctx = document.getElementById('map_ad').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: advertise,
            options: options
        });
        // Create the chart
        const ctxAgency = document.getElementById('map_agency').getContext('2d');
        const myChartAgency = new Chart(ctxAgency, {
            type: 'line',
            data: agency,
            options: options
        });
    </script>

</div>
