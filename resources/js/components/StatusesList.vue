<template>
    <div>
        <div class="card border-0 mb-3 shadow-sm" v-for="(status, index) in statuses" :key="index">
            <div class="card-body d-flex-flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded me-3 shadow-sm" width="40px" alt="" src="https://www.pmfarma.es/images/avatar-equipo.png">
                    <div>
                        <h5 class="mb-1">Eduardo Mogro</h5>
                        <div class="small text-muted">Hace una hora</div>
                    </div>
                </div>
                <p class="card-text text secondary">
                    {{ status.body }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() { 
        return {
            statuses: [],
        }
    },
    mounted() {
        axios.get('/statuses')
             .then(res => {
                 this.statuses = res.data.data;
             })
             .catch(err => {
                 console.log(err.response.data);
             });

        EventBus.$on('status-created', status => {
            this.statuses.unshift(status);
        });
    }
}
</script>

<style>

</style>