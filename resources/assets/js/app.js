require('./bootstrap');
require('jquery-slimscroll');
require('admin-lte');
require('icheck');

import Toastr from 'vue-toastr';

Vue.component('vue-toastr', Toastr);

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

Vue.component(
    'cost-price',
    require('./components/configuration/CostPrice.vue')
);

Vue.component(
    'inverter',
    require('./components/configuration/Inverter.vue')
);

Vue.component(
    'pv-current',
    require('./components/dashboard/PVCurrent.vue')
);

new Vue({
    el: '.wrapper'
});
