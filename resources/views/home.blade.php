@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <h1>Servers</h1>

                        <div id="app_servers" class="row">
                            <div class="col-xs-4">
                                <ul class="list-group">
                                    <li v-for="(server,key) in servers" class="list-group-item">
                                        <a href="#" class="" v-on:click="selectServer(key)">${ server.name }</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-8">

                                <template v-if="activeServer != null">

                                    <h3>${ servers[activeServer].name }</h3>
                                    <div class="col-xs-3">
                                        <strong>IP: </strong>
                                    </div>
                                    <div class="col-xs-9">
                                        ${ servers[activeServer].ip }
                                    </div>
                                    <div class="col-xs-3">
                                        <strong>COUNTRY: </strong>
                                    </div>
                                    <div class="col-xs-9">
                                        ${ servers[activeServer].geo_country }
                                    </div>

                                    <p>&nbsp;</p>
                                    <h3>Notifications settings :</h3>


                                    <div class="row" style="margin-bottom:30px" v-for="notification in servers[activeServer].notifications">
                                        <h4>${ notification.notification }</h4>
                                        <div class="col-xs-5">
                                            <strong>Enable notification: </strong>
                                        </div>
                                        <div v-on:click="setNoficationSend(0,notification.id)" class="col-xs-7" v-if="notification.send_notification = 1">
                                            <a href="#">ENABLED</a>
                                        </div>
                                        <div v-on:click="setNoficationSend(1,notification.id)" class="col-xs-7" v-else>
                                            <a href="#">DISABLED</a>
                                        </div>

                                        <div class="col-xs-5">
                                            <strong>Send EMAIL to : </strong>
                                        </div>
                                        <div class="col-xs-7">
                                            <input type="text" placeholder="Enter email" class="form-control" value="notification.send_email_to">
                                        </div>

                                        <div class="col-xs-5">
                                            <strong>Send SMS to : </strong>
                                        </div>
                                        <div class="col-xs-7">
                                            <input type="text" placeholder="Enter PHONE NUMBER" class="form-control" value="notification.send_email_to">
                                        </div>
                                    </div>


                                </template>
                                <template v-else>
                                    Chose
                                </template>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
