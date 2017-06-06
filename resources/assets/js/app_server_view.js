window.Vue = require('vue');
var axios = require('axios');
require('moment');


const app = new Vue({
    delimiters: ['${', '}'],
    el: '#app_server_view',
    components: {
    },
    data: {

        datetime: '',
        interval: '1m',
        base_interval: '1m',
        base_datetime: '',
        graph_loading: false,
        panels: {
            cpu: false
        },
        'custom_data': [],
        'servers': [],
        'group': {
            total: {
                storage: {
                    total: 0,
                    used: 0,
                    percent: 0
                },
                memory: {
                    total: 0,
                    used: 0,
                    percent: 0
                },
                bandwidth: {
                    avg: 0,
                    max: 0
                }
            }
        },
        'activeServer': null
    },


    created: function() {

        axios.get("/api/v1/group/1/metrics", {
            'params': {api_key: 'kevin_api'}
        }).then(function (response) {
            var data = response.data;
            app.group = data;
        });
    },

        methods: {

        formatHumanSizes: function(bytes) {
            if (bytes >= 1073741824*1024)
            {
                bytes = Math.round(bytes / 1073741824*1024, 2) + 'TB';
            }
            if (bytes >= 1073741824)
            {
                bytes = Math.round(bytes / 1073741824, 2) + 'GB';
            }
            else if (bytes >= 1048576)
            {
                bytes = Math.round(bytes / 1048576, 2) + 'MB';
            }
            else if (bytes >= 1024)
            {
                bytes = Math.round(bytes / 1024, 2) + 'KB';
            }
            else if (bytes > 1)
            {
                bytes = bytes = 'b';
            }
            else if (bytes == 1)
            {
                bytes = bytes +'b';
            }
            else
            {
                bytes = '0 bytes';
            }

            return bytes;
        },

            saveChanges: function() {
                this.base_datetime = this.datetime;
                this.base_interval = this.interval;
            },
        ifUnsavedChanges: function() {
            if(this.base_datetime != this.datetime || this.base_interval != this.interval) {
                return true;
            } else {
                return false;
            }
        },
        ifPanelOpenned: function() {
            for(var i in this.panels) {
                if(this.panels[i] == true) return true;
            }
            return false;
        },
            updateInterval: function(d) {
                this.interval = d;
            },
            updateDatetime: function(d) {
                this.datetime = d;
            },
        resetDatetime: function() {
            this.datetime = "";
        },

        selectServer: function (id) {
            if(typeof(this.servers[id]) == "undefined" ) {
                this.activeServer = null;
            }
            this.activeServer = id;

        },

        setNoficationSend: function(action,notification_id) {
            var _activeServer = this.servers[this.activeServer];

            axios.post("/api/v1/server/"+_activeServer.id+"/notification/"+notification_id, {
                'params': {
                    api_key: 'kevin_api',
                    return_full_data: 1,
                    send_notification: action
                }
            }).then(function (response) {
                var data = response.data;
                console.log(data);
                //app.servers = data;
            });

        }
    }

});


/*

import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'redis'
    // key: 'your-pusher-key'
});

*/
