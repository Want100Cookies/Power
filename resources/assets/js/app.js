require('./bootstrap');
require('jquery-slimscroll');
require('admin-lte');
require('icheck');

// https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#advice

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

if ($("#passport").length) {
    new Vue({
        el: '#passport'
    });
}
