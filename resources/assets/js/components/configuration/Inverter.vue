<style scoped>

</style>

<template>
    <div class="row">
        <form role="form"
              v-on:submit.prevent="store()">
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
                        type="submit">
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
                axios.all([
                    this.getSetting('inverter_ip', ip),
                    this.getSetting('inverter_port', port),
                    this.getSetting('inverter_serial', serial),
                    this.getSetting('inverter_id', 'id'),
                ]);
            },

            getSetting(endPoint, localKey) {
                return axios.get('/api/v1/settings/' + endPoint)
                    .then(response => {
                        this[localKey] = response.data.value;
                    });
            },

            store() {
                axios.all([
                    this.storeIP(),
                    this.storePort(),
                    this.storeSerial(),
                    this.storeId(),
                ]).then(data => {
                    console.log('success', data);
                });
            },

            // Todo: reduce number of methods (something like setSetting)

            storeIP() {
                return axios.put('/api/v1/settings/inverter_ip', {
                    value: this.ip
                }).then(response => {
                    this.ip = response.data.value;
                }).catch(error => {
                    console.error('error', error);
                });
            },

            storePort() {
                return axios.put('/api/v1/settings/inverter_port', {
                    value: this.port
                }).then(response => {
                    this.port = response.data.value;
                }).catch(error => {
                    console.error('error', error);
                });
            },

            storeSerial() {
                return axios.put('/api/v1/settings/inverter_serial', {
                    value: this.serial
                }).then(response => {
                    this.serial = response.data.value;
                }).catch(error => {
                    console.error('error', error);
                });
            },

            storeId() {
                return axios.put('/api/v1/settings/inverter_id', {
                    value: this.id
                }).then(response => {
                    this.id = response.data.value;
                }).catch(error => {
                    console.error('error', error);
                });
            },
        }
    }
</script>