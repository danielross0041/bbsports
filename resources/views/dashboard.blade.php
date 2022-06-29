@extends('layouts.main') 
@section('content')
 <main>
            <div class="container-fluid site-width">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-md-0 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Dashboard</h4> <p>Welcome to admin panel</p>
                               <!--  <a href="#" class="btn btn-primary">Get Started <i class="fas fa-arrow-right"></i></a>  -->
                            </div>
                            <div class="card border-bottom-0 mt-3 mt-sm-0">                            
                                <div class="card-content border-bottom border-primary border-w-5">
                                    <div class="card-body p-4">                                 

                                        <span class="mb-0 font-w-600 text-primary">Income balance</span><br>
                                        <p class="mb-0 font-w-500 tx-s-12">${{number_format($balance , 2)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                {{--
                <div class="row">

                    <div class="col-12 col-lg-12  mt-3">

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="card outline-badge-primary">
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>                                                   
                                                    <span class="cf card-liner-icon cf-btc mt-2"></span>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title">${{number_format($balance , 2)}}</h2>
                                                        <h6 class="card-liner-subtitle">Balance</h6>                                       
                                                    </div>                                
                                                </div>
                                                <span class="bg-danger card-liner-absolute-icon text-white card-liner-small-tip">{{count($orders)}}</span>
                                                <div id="apex_primary_chart_balance"></div>                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="card outline-badge-primary">
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <span class="cf card-liner-icon cf-eth mt-2"></span>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title">{{count($users)}}</h2>
                                                        <h6 class="card-liner-subtitle">User Registration</h6> 
                                                    </div>                                
                                                </div>
                                                <span class="bg-primary card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>
                                                <div id="apex_today_visitors_more"></div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6  mt-3">
                                        <div class="card outline-badge-primary">
                                            <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <span class="cf card-liner-icon cf-xrp mt-2"></span>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title">${{number_format($balance_refund , 2)}}</h2>
                                                        <h6 class="card-liner-subtitle">Refund</h6> 
                                                    </div>                                
                                                </div>
                                                <span class="bg-info card-liner-absolute-icon text-white card-liner-small-tip">{{$balance_count}}</span>
                                                <div id="apex_today_sale_more"></div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3">
                                        <div class="card outline-badge-primary">
                                            <!-- <div class="card-body">
                                                <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                                                    <span class="cf card-liner-icon cf-usdt mt-2"></span>
                                                    <div class='card-liner-content'>
                                                        <h2 class="card-liner-title">$252.56</h2>
                                                        <h6 class="card-liner-subtitle">Tether</h6> 
                                                    </div>                                
                                                </div>
                                                <span class="bg-warning card-liner-absolute-icon text-white card-liner-small-tip">+4.8%</span>
                                                <div id="apex_today_profit"></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="card">                           
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div id="apex_crypto_chart_more" class="height-500"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   



                    <div class="col-12  col-md-6 col-lg-3 mt-3">
                        <div class="card border-bottom-0">                            
                            <div class="card-content border-bottom border-primary border-w-5">
                                <div class="card-body p-4">                                   
                                    <div class="d-flex">                                        
                                        <div class="circle-50 outline-badge-primary"> <span class="cf card-liner-icon cf-ltc mt-2"></span></div>
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 h6 font-w-600">PACKAGE</span><br>
                                            <p class="mb-0 font-w-500 h6">{{count($packages)}}</p>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12  col-md-6 col-lg-3 mt-3">
                        <div class="card border-bottom-0">                            
                            <div class="card-content border-bottom border-warning border-w-5">
                                <div class="card-body p-4">                                   
                                    <div class="d-flex">                                        
                                        <div class="circle-50 outline-badge-warning"> <span class="cf card-liner-icon cf-xlm mt-2"></span></div>
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 h6 font-w-600">TESTIMONIAL</span><br>
                                            <p class="mb-0 font-w-500 h6">{{count($testimonials)}}</p>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12  col-md-6 col-lg-3 mt-3">
                        <div class="card border-bottom-0">                            
                            <div class="card-content border-bottom border-success border-w-5">
                                <div class="card-body p-4">                                   
                                    <div class="d-flex">                                        
                                        <div class="circle-50 outline-badge-success"> <span class="cf card-liner-icon cf-link mt-2"></span></div>
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 h6 font-w-600">MONTHLY REPORTS</span><br>
                                            <p class="mb-0 font-w-500 h6">0</p>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12  col-md-6 col-lg-3 mt-3">
                        <div class="card border-bottom-0">                            
                            <div class="card-content border-bottom border-info border-w-5">
                                <div class="card-body p-4">                                   
                                    <div class="d-flex">                                        
                                        <div class="circle-50 outline-badge-info"> <span class="cf card-liner-icon cf-xmr mt-2"></span></div>
                                        <div class="media-body align-self-center pl-3">
                                            <span class="mb-0 h6 font-w-600">EDUCATION MATERIAL</span><br>
                                            <p class="mb-0 font-w-500 h6">0</p>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12  mt-3">
                        <div class="card outline-badge-primary">                            
                            <div class="card-content">
                                <div class="card-body p-4">   
                                    <div class="d-md-flex">
                                        <div class="my-auto">
                                            <img src="{{asset('images/money.png')}}" alt="author"  class="my-auto">
                                        </div>
                                        <div class="content px-md-3 my-3 my-md-0">                                           
                                            <span class="mb-0 font-w-600 h5">BB SPORTS</span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">See forex trading in a new light.</p>                                                    

                                        </div>
                                        <div class="my-auto">
                                            <a href="{{url('/')}}" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">View Website</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h6 class="card-title">Users Wallet</h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0">
                                    <ul class="list-group list-unstyled">
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-primary"><span>ML</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Max S. Lewis</span><br>
                                                    <small class="mb-0 font-w-500">msl@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-secondary"><span>TW</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Timothy S. Williamson</span><br>
                                                    <small class="mb-0 font-w-500">tsw@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-info"><span>HW</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Harry J. Mitchell</span><br>
                                                    <small class="mb-0 font-w-500">hjm@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-warning"><span>JS</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">John M. Stokes</span><br>
                                                    <small class="mb-0 font-w-500">jms@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-success"><span>JP</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Joshua P. Morrison</span><br>
                                                    <small class="mb-0 font-w-500">jpm@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-danger"><span>LC</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Lester V. Cargo</span><br>
                                                    <small class="mb-0 font-w-500">lvc@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>


                                    </ul> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-3">
                        <div class="card border-top-0">                          
                            <div class="card-content border-top border-primary border-w-5">
                                <div class="card-body p-0">
                                    <ul class="list-group list-unstyled">
                                        <li class="p-4 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-primary"><span>ML</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Max S. Lewis</span><br>
                                                    <small class="mb-0 font-w-500">msl@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li> 
                                    </ul>
                                    <div class="table-responsive">
                                        <table class="table table-borderless pick-table mb-2">
                                            <thead>
                                                <tr>
                                                    <th>Currency</th>                                                  
                                                    <th class="text-right">Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Bitcoin</td>                                                   
                                                    <td class="text-right text-success">$80,200 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Ethereum</td>                                                  
                                                    <td class="text-right text-success">$78,410 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>XRP</td>                                                   
                                                    <td class="text-right text-danger">$162,050 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Tether</td>                                                   
                                                    <td class="text-right text-success">$187,792 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Litecoin</td>                                                    
                                                    <td class="text-right text-danger">$13,087 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>Chainlink</td>                                                    
                                                    <td class="text-right text-success">$23,087 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex outline-badge-primary border-0">
                                        <div class="w-50 text-center p-3 border-right"><a href="#" class="font-weight-bold">View Profile <i class="fas fa-arrow-right"></i></a></div>
                                        <div class="w-50 text-center p-3"><a href="#" class="text-danger font-weight-bold">Logout <span class="icon-logout"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4 mt-3">
                        <div class="card border-bottom-0">                          
                            <div class="card-content border-bottom border-info border-w-5">
                                <div class="card-body">
                                    <nav>
                                        <div class="nav nav-tabs font-weight-bold border-bottom" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Litecoin</a>
                                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Stellar</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Chainlink</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="py-3 border-bottom border-primary">
                                                <span class="text-muted font-w-600">Litecoin Stats</span><br>
                                                <p class="mb-0 font-w-500 h3">$1,247.05</p>                                                    
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless pick-table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Month</th>                                                  
                                                            <th class="text-right">Stats</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Jan</td>                                                   
                                                            <td class="text-right text-success">$80,200 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fed</td>                                                  
                                                            <td class="text-right text-success">$78,410 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                   
                                                            <td class="text-right text-danger">$162,050 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                   
                                                            <td class="text-right text-success">$187,792 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                    
                                                            <td class="text-right text-danger">$13,087 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                    
                                                            <td class="text-right text-success">$23,087 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <div class="py-3 border-bottom border-primary">
                                                <span class="text-muted font-w-600">Stellar Stats</span><br>
                                                <p class="mb-0 font-w-500 h3">$2,247.1205</p>                                                    
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless pick-table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Month</th>                                                  
                                                            <th class="text-right">Stats</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Jan</td>                                                   
                                                            <td class="text-right text-success">$34,200 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fed</td>                                                  
                                                            <td class="text-right text-success">$21,122 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                   
                                                            <td class="text-right text-danger">$12,456 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                   
                                                            <td class="text-right text-success">$44,234 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                    
                                                            <td class="text-right text-danger">$77,765 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                    
                                                            <td class="text-right text-success">$23,234 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                            <div class="py-3 border-bottom border-primary">
                                                <span class="text-muted font-w-600">Chainlink Stats</span><br>
                                                <p class="mb-0 font-w-500 h3">$11,21,247.05</p>                                                    
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-borderless pick-table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Month</th>                                                  
                                                            <th class="text-right">Stats</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Jan</td>                                                   
                                                            <td class="text-right text-success">$20,200 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fed</td>                                                  
                                                            <td class="text-right text-success">$58,410 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                   
                                                            <td class="text-right text-danger">$152,050 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                   
                                                            <td class="text-right text-success">$187,792 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>March</td>                                                    
                                                            <td class="text-right text-danger">$13,087 <i class="ion ion-arrow-graph-down-right"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td>April</td>                                                    
                                                            <td class="text-right text-success">$23,087 <i class="ion ion-arrow-graph-up-right"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                --}}
                <!-- END: Card DATA-->                 
            </div>
        </main>
@endsection
@section('css') 
@endsection 
@section('js') 
<script>
    var theme = 'light';
    if ($("#apex_primary_chart_balance").length > 0)
    {
        options = {
            chart: {
                type: 'line',
                height: 80,
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 2,
                    color: '#000',
                    opacity: 0.7,
                }
            },
            series: [{
                    data: [<?php echo $previous_balance ?>]
                }],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0
                }
            },
            colors: ['#1e3d73'],
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                            return '';
                        }
                    }
                }
            },
            responsive: [{
                    breakpoint: 1351,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                },
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 80,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 45,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                }

            ]
        }


        var chart = new ApexCharts(
                document.querySelector("#apex_primary_chart_balance"),
                options
                );
        chart.render();
    }


    // For User
    if ($("#apex_today_visitors_more").length > 0)
    {
        options = {
            chart: {
                type: 'line',
                height: 80,
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 2,
                    color: '#28a745',
                    opacity: 0.7,
                }
            },
            series: [{
                    data: [41, 9, 36, 12, 44, 25, 59, 41, 66, 25]
                }],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0
                }
            },
            colors: ['#28a745'],
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                            return '';
                        }
                    }
                }
            },
            responsive: [{
                    breakpoint: 1351,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                },
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 80,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 45,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                }

            ]
        }


        var chart = new ApexCharts(
                document.querySelector("#apex_today_visitors_more"),
                options
                );
        chart.render();
    }


    if ($("#apex_today_sale_more").length > 0)
    {
        options = {
            chart: {
                type: 'line',
                height: 80,
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 2,
                    color: '#17a2b8',
                    opacity: 0.7,
                }
            },
            series: [{
                    data: [<?php echo $previous_balance_refund; ?>]
                }],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            markers: {
                size: 0
            },
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0
                }
            },
            colors: ['#17a2b8'],
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function formatter(val) {
                            return '';
                        }
                    }
                }
            },
            responsive: [{
                    breakpoint: 1351,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                },
                {
                    breakpoint: 1200,
                    options: {
                        chart: {
                            height: 80,
                        },
                        grid: {
                            padding: {
                                top: 35,
                                bottom: 0,
                                left: 40
                            }
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 95,
                        },
                        grid: {
                            padding: {
                                top: 45,
                                bottom: 0,
                                left: 0
                            }
                        },
                    },
                }

            ]
        }


        var chart = new ApexCharts(
                document.querySelector("#apex_today_sale_more"),
                options
                );
        chart.render();
    }

    if ($("#apex_crypto_chart_more").length > 0)
    {
        options = {
            theme: {
                mode: theme
            },
            chart: {
                height: 320,
                type: 'bar',
            },
            responsive: [
                {
                    breakpoint: 767,
                    options: {
                        chart: {
                            height: 220
                        }
                    }
                }
            ],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            colors: ['#1e3d73', '#17a2b8'],
            series: [{
                    name: 'Transaction',
                    data: [<?php echo $previous_balance ?>]
                }, {
                    name: 'Refund',
                    data: [<?php echo $previous_balance_refund; ?>]
                }],
            xaxis: {
                categories: [<?php echo $sale_dates; ?>],
            },
            yaxis: {
                title: {
                    text: '(dollar)'
                }
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " dollar"
                    }
                }
            }
        }

        var chart = new ApexCharts(
                document.querySelector("#apex_crypto_chart_more"),
                options
                );
        chart.render();
    }
</script>
@endsection