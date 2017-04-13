<style scoped>
    .table-responsive {
        min-height: 50px;
        max-height: 150px;
        overflow-y: auto;
    }
</style>

<template>
    <div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="info-box bg-red">
                <span class="info-box-icon">
                    <i class="fa fa-fire"></i>
                </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Gas price
                            <button type="button"
                                    class="btn btn-default btn-xs pull-right"
                                    @click="showCreateModal('gas')">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </span>
                        <span class="info-box-number">&euro; {{ lastGas }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box bg-yellow">
                <span class="info-box-icon">
                    <i class="fa fa-bolt"></i>
                </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            Electricity price
                            <button type="button"
                                    class="btn btn-default btn-xs pull-right"
                                    @click="showCreateModal('electricity')">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </span>
                        <span class="info-box-number">&euro; {{ lastElectricity }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Gas price history</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                                <tr v-for="price in filterPrices('gas')">
                                    <td>&euro; {{ price.price }}</td>
                                    <td>{{ price.created_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Electricity price history</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                                <tr v-for="price in filterPrices('electricity')">
                                    <td>&euro; {{ price.price }}</td>
                                    <td>{{ price.created_at }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade"
             tabindex="-1"
             role="dialog"
             id="priceModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-labelledby="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Add new price</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="form.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in form.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <form class="form-horizontal" role="form" @submit.prevent="store">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input type="number"
                                           min="0"
                                           maxlength="10"
                                           class="form-control"
                                           name="price"
                                           v-model="form.price"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal">
                            Close
                        </button>
                        <button type="button"
                                class="btn btn-primary"
                                @click="store">
                            Add price
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                prices: [],
                lastGas: "...",
                lastElectricity: "...",

                form: {
                    type: '',
                    price: '',
                    errors: []
                }
            };
        },

        ready() {
            this.prepareComponent();
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                this.getPrices();
                this.getLastPrices();
            },

            getPrices() {
                axios.get('/api/v1/cost-price')
                    .then(response => {
                        this.prices = response.data;
                    })
            },

            getLastPrices() {
                axios.get('/api/v1/cost-price/last/electricity')
                    .then(response => {
                        this.lastElectricity = response.data.price;
                    });

                axios.get('/api/v1/cost-price/last/gas')
                    .then(response => {
                        this.lastGas = response.data.price;
                    });
            },

            filterPrices(type) {
                let list = [];

                for (let i = 0; i < this.prices.length; i++) {
                    if (this.prices[i].type === type) {
                        list.push(this.prices[i]);
                    }
                }

                return list;
            },

            store() {
                this.form.errors = [];

                axios.post('/api/v1/cost-price', this.form)
                    .then(response => {
                       this.form.price = 0;
                       this.form.type = '';
                       this.form.errors = [];

                       this.prices.unshift(response.data);

                       $('#priceModal').modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            this.form.errors = _.flatten(_.toArray(error.response.data));
                        } else {
                            this.form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            showCreateModal(type) {
                this.form.type = type;

                switch (type) {
                    case 'gas':
                        this.form.price = this.lastGas;
                        break;
                    case 'electricity':
                        this.form.price = this.lastElectricity;
                        break;
                }

                $('#priceModal').modal('show');
            }
        }
    }
</script>