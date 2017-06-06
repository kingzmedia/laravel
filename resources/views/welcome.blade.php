@extends('layouts.app')

@section('content')


    <style type="text/css">
        .alert-warning {
            color: #b37c0a !important;
        }
        .summary-danger {
            text-align:center;background: #c2190e;color:#fff;border-right:1px solid #fff;position:relative;
        }
        .summary-success {
            text-align:center;background:#7AC29A;color:#fff;border-right:1px solid #fff;position:relative;
        }
        .summary-alert {
            text-align:center;background:#c2ae0f;color:#fff;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .8s
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
            opacity: 0
        }
        .slide-fade-enter-active {
            transition: all .8s ease;
        }
        .slide-fade-leave-active {
            transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
        }
        .slide-fade-enter, .slide-fade-leave-to
            /* .slide-fade-leave-active for <2.1.8 */ {
            transform: translateX(10px);
            opacity: 0;
        }
    </style>
    <style type="text/css">
        .table.table-border-fff, .table.table-border-fff tbody tr td {
            border-top:1px solid #fff;
        }
    </style>

    <div class="content">
        <div class="container-fluid" id="app_server_view" style="position:relative">

            <div class="row">


                <transition name="fade">
                <div v-if="ifPanelOpenned()" style="position:absolute;left:0px;right:0px;width:100%;height:100%;background:#f4f3ef;opacity:0.5;z-index:999"></div>
                </transition>

                <transition name="slide-fade">
                    <div v-if="panels.cpu" class="col-sm-12" style="position:absolute;z-index:1000;">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-11">
                                    <div class="icon-big icon-warning">
                                        <i class="ti-server"></i>  <span style="color:#000">CPU STATS</span>
                                    </div>
                                </div>

                                <div class="col-xs-1 text-right"><a href="#" v-on:click="panels.cpu = false;custom_data = []">X</a></div>
                            </div>
                            <div class="row" style="min-height:500px;margin-top:20px">
                                <div class="col-xs-12">


                                    <div class="col-xs-12">
                                        <h3>GRAPH</h3>

                                    </div>
                                    <div class="col-xs-12">
                                        <h3>GLOBAL</h3>
                                        <table class="table table-hover table-border-fff">
                                            <thead>
                                            <tr>
                                                <th style="width:80px;text-align:center;">AVG LOAD</th>
                                                <th style="width:80px;text-align:center;">IRQ</th>
                                                <th style="width:80px;text-align:center;">NICE</th>
                                                <th style="width:80px;text-align:center;">SYSTEM</th>
                                                <th style="width:80px;text-align:center;">USER</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th style="width:80px;text-align:center;">AVG LOAD</th>
                                                <th style="width:80px;text-align:center;">IRQ</th>
                                                <th style="width:80px;text-align:center;">NICE</th>
                                                <th style="width:80px;text-align:center;">SYSTEM</th>
                                                <th style="width:80px;text-align:center;">USER</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-12">
                                    <h3>PER CORE(S)</h3>
                                    <table class="table table-hover table-border-fff">
                                        <thead>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        <tr>
                                            <th style="width:50px;">CORE</th>
                                            <th style="width:80px;text-align:center;">AVG LOAD</th>
                                            <th style="width:80px;text-align:center;">IRQ</th>
                                            <th style="width:80px;text-align:center;">NICE</th>
                                            <th style="width:80px;text-align:center;">SYSTEM</th>
                                            <th style="width:80px;text-align:center;">USER</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-plus"></i> Usage <span style="color:#7AC29A;font-weight:bold">${ group.total.storage.percent } %</span> - ${ group.total.storage.used/1024/1024 }/${ group.total.storage.total/1024/1024 }GB
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            </div>


            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-warning text-center">
                                        <i class="ti-server"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Storage Total</p>
                                         ${ formatHumanSizes(group.total.storage.total) }
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-plus"></i> Usage <span style="color:#7AC29A;font-weight:bold">${ group.total.storage.percent } %</span> - ${ formatHumanSizes(group.total.storage.used) }/${ formatHumanSizes(group.total.storage.total) }
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-danger text-center">
                                        <i class="ti-pulse"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Avg Bandwith</p>
                                        ${ formatHumanSizes(group.total.bandwidth.avg) }/s
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-plus"></i> In the past day. Max : ${ formatHumanSizes(group.total.bandwidth.max) }/s
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5">
                                    <div class="icon-big icon-info text-center">
                                        <i class="ti-ticket"></i>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                        <p>Memory Total</p>
                                        ${ formatHumanSizes(group.total.memory.total) }
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-plus"></i> Usage <span style="color:#7AC29A;font-weight:bold">${ Math.floor(group.total.memory.percent) }%</span> - ${ formatHumanSizes(group.total.memory.used) }/${ formatHumanSizes(group.total.memory.total) }
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <div class="">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class=" ">

                                        <div class="dropdown" style="margin-top:95px">
                                            <button href="#" class="btn btn-lg btn-default btn-block dropdown-toggle" data-toggle="dropdown">
                                                <i class="ti-wand"></i> Action
                                                <b class="caret"></b>
                                            </button>
                                            <ul class="dropdown-menu btn-block">
                                                <li><a href="#">Add/Unbind Server</a></li>
                                                <li><a href="#">Create new group</a></li>
                                                <li><a href="#">Clone this group</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Delete this group</a></li>
                                            </ul>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <transition name="fade">
            <div class="alert alert-warning" v-if="datetime != ''" style="margin-bottom:10px">
                <span><b> Warning - </b> You have setup a date, the data was "historical". Click on "Back to live data" for come back</span>
            </div>
            </transition>
                <transition name="fade">
                    <div class="alert alert-info" v-if="ifUnsavedChanges()" style="margin-bottom:20px">
                        <span><b> Warning - </b> You have to click on button "next" for save changes and get new data</span>
                    </div>
                </transition>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card" style="position:relative">
                        <transition name="fade">
                        <div v-if="graph_loading" style="position: absolute;width:100%;height:100%;text-align:center;padding-top:100px;font-size:18px;font-weight:bold;background:rgba(255,255,255,0.5);z-index:1000">
                            <span style="border-radius:5px;background:rgba(255,255,255,0.8);padding:15px;border:2px solid #eee">Loading in progress..</span>
                        </div>
                        </transition>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-5 col-md-6">
                                    <div class="numbers pull-left">GROUP X</div>
                                </div>
                                <div class="col-xs-2">
                                    <select class="selectpicker" v-model="interval" data-style="btn btn-block" data-size="7" v-on:change="updateInterval($event.target.value)">
                                        <option value="1m">1M</option>
                                        <option value="15m">15M</option>
                                        <option value="30m">30M</option>
                                        <option value="1h">1 Hour</option>
                                        <option value="1d">1 Day</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-md-3" style="position:relative;text-align:right;height:80px;">
                                    <!--<input class="datepicker-input datetimepicker form-control" type="text" :id="dtp" :value="value" v-model="value" v-on:keyup,change="emitValue()"-->
                                    <input type="text" class="form-control datetimepicker" v-model="datetime"
                                           v-on:input="updateDatetime($event.target.value)"
                                           v-on:blur="updateDatetime($event.target.value)"
                                           v-on:focus="updateDatetime($event.target.value)">
                                    <a v-on:click="resetDatetime" href="#" style="color: #5f5f5f;"><i class="ti-reload"></i> Back to live data</a>
                                </div>
                                <div class="col-xs-1"><button class="btn btn-primary" v-on:click="saveChanges"><i class="ti-angle-double-right" style="font-size:20px"></i></button></div>

                            </div>


                            <table class="table table-hover table-border-fff">
                                <thead>
                                <tr>
                                    <th style="width:150px;">&nbsp;</th>
                                    <th style="width:80px;text-align:center;">CPU</th>
                                    <th style="width:80px;text-align:center;">MEM</th>
                                    <th style="width:80px;text-align:center;">DISK</th>
                                    <th style="width:80px;text-align:center;">UPLO</th>
                                    <th style="width:80px;text-align:center;">DOWN</th>
                                    <th style="width:80px;text-align:center;">ERR</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="server in group.servers">
                                    <td>
                                            <span style="font-weight:bold;font-size:15px">
                                                <span v-if="server.agent_connected" class="label label-success"><i class="ti-bolt-alt"></i></span>
                                                <span v-else class="label label-danger"><i class="ti-close"></i></span>

                                                ${ server.name }</span>
                                        <span style="display:block;font-size:11px;">${ server.ip } | DEBIAN 8</span>
                                    </td>
                                    <td v-bind:class="[{ 'summary-success': server.summary.cpu < 50},{ 'summary-success': server.summary.cpu < 70}, {'summary-danger flashing': server.summary.cpu >= 70 }]">
                                        ${ server.summary.cpu }% <span class="label label-default" style="position:absolute;top:10px;right:10px;cursor:pointer; background:#fff;color:#3f9459" v-on:click="panels.cpu = true"><i class="ti-help"></i></span>
                                    </td>

                                    <td v-bind:class="[{ 'summary-success': server.summary.memory < 60},{ 'summary-success': server.summary.memory < 80}, {'summary-danger flashing': server.summary.memory >= 80 }]">
                                        ${ server.summary.memory }% <span class="label label-default" style="position:absolute;top:10px;right:10px;cursor:pointer; background:#fff;color:#3f9459" data-toggle="modal" data-target="#myModal"><i class="ti-help"></i></span>
                                    </td>
                                    <td v-bind:class="[{ 'summary-success': server.summary.storage < 60},{ 'summary-success': server.summary.storage < 80}, {'summary-danger flashing': server.summary.storage >= 80 }]">
                                        ${ server.summary.storage }%</td>
                                    <td style="text-align:center;">22</td>
                                    <td style="text-align:center;">33</td>
                                    <td style="text-align:center;background:#b20000;color:#fff;position:relative;" class="flashing">
                                        33
                                    </td>
                                </tr>



                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="footer-title">----------</div>
                            <div class="pull-right">
                                <button class="btn btn-info btn-fill btn-icon btn-sm">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="margin-bottom:60px">
                            <div class="pull-left">
                                <h4 class="card-title">Your note</h4>
                                <p class="category">You can set some informations</p>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-success"><i class="ti-plus"></i> Add note</button>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="table-full-width table-tasks">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" value="" data-toggle="checkbox">
                                            </label>
                                        </td>
                                        <td>Update vCores for SERVER #3</td>
                                        <td class="td-actions text-right">
                                            <div class="table-icons">
                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                            </label>
                                        </td>
                                        <td>A lot of INET ERRORS was spawned on server #2, cause of apache bug. Updated version</td>
                                        <td class="td-actions text-right">
                                            <div class="table-icons">
                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                            </label>
                                        </td>
                                        <td>A lot of INET ERRORS was spawned on server #2, cause of apache bug. Updated version</td>
                                        <td class="td-actions text-right">
                                            <div class="table-icons">
                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                            </label>
                                        </td>
                                        <td>A lot of INET ERRORS was spawned on server #2, cause of apache bug. Updated version</td>
                                        <td class="td-actions text-right">
                                            <div class="table-icons">
                                                <button type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Task">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                    <i class="ti-close"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-history"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="card card-timeline card-plain">
                        <div class="card-content">
                            <ul class="timeline timeline-simple">
                                <li class="timeline-inverted">
                                    <div class="timeline-badge danger">
                                        <i class="ti-alert"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <span class="label label-danger">SERVER DISCONNECTION > SERVER #4 (127.0.0.1)</span>

                                        </div>
                                        <div class="timeline-body">
                                            <p>Your server #3 was disconnected from out collector</p>
                                        </div>
                                        <h6>
                                            <i class="ti-time"></i>
                                            11 hours ago
                                        </h6>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>


        </div>

@endsection

@section("javascripts")
        <script src="{{ asset('js/app_server_view.js') }}"></script>
@endsection