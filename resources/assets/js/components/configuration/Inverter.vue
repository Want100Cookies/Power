<style scoped>

</style>

<template>
    <div class="row">
        <form role="form">
            <div class="col-lg-2 col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Inverter IP</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" class="form-control" name="ip" v-model="ip"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Inverter Port</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" class="form-control" name="port" v-model="port"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Inverter Serial</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" class="form-control" name="ip" v-model="serial"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-sm-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Inverter ID</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" class="form-control" name="ip" v-model="id"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <button role="button"
                        class="btn btn-lg btn-success"
                        @click="store()">
                    Save
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ip: '...',
                port: '8899',
                serial: '...',
                id: '...',
                errors: []
            }
        },

        ready() {
            this.prepareComponent();
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent() {
                this.getIP();
                this.getPort();
                this.getSerial();
                this.getId();
            },

            getIP() {
                axios.get('/api/v1/settings/inverter_ip')
                    .then(response => {
                        this.ip = response.data.value;
                    })
            },

            getPort() {
                axios.get('/api/v1/settings/inverter_port')
                    .then(response => {
                        this.port = response.data.value;
                    });
            },

            getSerial() {
                axios.get('/api/v1/settings/inverter_serial')
                    .then(response => {
                        this.serial = response.data.value;
                    });
            },

            getId() {
                axios.get('/api/v1/settings/inverter_id')
                    .then(response => {
                        this.id = response.data.value;
                    });
            },

            store() {
                this.storeIP();
                this.storePort();
                this.storeSerial();
                this.storeId();
            },

            storeIP() {
                axios.put('/api/v1/settings/inverter_ip', {
                    value: this.ip
                })
                    .then(response => {
                        this.ip = response.data.value;
                    });
            },

            storePort() {
                axios.put('/api/v1/settings/inverter_port', {
                    value: this.port
                })
                    .then(response => {
                        this.port = response.data.value;
                    });
            },

            storeSerial() {
                axios.put('/api/v1/settings/inverter_serial', {
                    value: this.serial
                })
                    .then(response => {
                        this.serial = response.data.value;
                    });
            },

            storeId() {
                axios.put('/api/v1/settings/inverter_id', {
                    value: this.id
                })
                    .then(response => {
                        this.id = response.data.value;
                    });
            },
        }
    }
</script>