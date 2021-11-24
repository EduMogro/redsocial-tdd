<template>
    <div>
        <div class="card border-0 mb-3 shadow-sm" v-for="(status, index) in statuses" :key="index">
            <div class="card-body d-flex-flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded me-3 shadow-sm" width="40px" alt="" src="https://www.pmfarma.es/images/avatar-equipo.png">
                    <div>
                        <h5 class="mb-1">{{ status.user_name }}</h5>
                        <div class="small text-muted">{{ status.ago }}</div>
                    </div>
                </div>
                <p class="card-text text secondary">
                    {{ status.body }}
                </p>
            </div>
            <div class="card-footer p-2">
                <button v-if="status.is_liked" 
                        @click="unlike(status)"
                        class="btn btn-link btn-sm"
                        style="text-decoration: none;" 
                        dusk="btn-unlike">
                        <i class="fa fa-thumbs-up"></i>
                        <strong>TE GUSTA</strong>
                </button>
                <button v-else 
                        @click="like(status)"
                        class="btn btn-link btn-sm"
                        style="text-decoration: none;" 
                        dusk="btn-like">
                        <i class="far fa-thumbs-up"></i>
                        ME GUSTA
                </button>
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
    },
    methods: {
        like(status) {
            axios.post(`/statuses/${status.id}/likes`)
             .then(res => {
                 status.is_liked = true;
             })
             .catch(err => {
                 console.log(err.response.data);
             });
        },
        unlike(status) {
            axios.delete(`/statuses/${status.id}/likes`)
             .then(res => {
                 status.is_liked = false;
             })
             .catch(err => {
                 console.log(err.response.data);
             });
        }
    }
}
</script>

<style>

</style>