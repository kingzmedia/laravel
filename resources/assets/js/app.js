require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    delimiters: ['${', '}'],
    el: '#app_servers',
    data: {
        'servers': [],
        'activeServer': null
    },

    created: function() {

        axios.get("/api/v1/servers", {
            'params': {api_key: 'kevin_api'}
        }).then(function (response) {
            var data = response.data;
            app.servers = data;
        });
    },

    methods: {
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
