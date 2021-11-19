<template>
    <div>
        <form @submit.prevent="submit">
            <div class="card-body">
                <textarea v-model="body" name="body" class="form-control border-0" placeholder="¿En qué estás pensando?"></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
        <!-- <div v-for="(status, index) in statuses" :key="index">
            {{ status.body }}
        </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            body: '',
            // statuses: []
        }
    },
    methods: {
        submit() {
            axios.post('/statuses', {body: this.body})
                 .then(res => {
                    //  console.log(res.data)
                    // this.statuses.push(res.data);
                    EventBus.$emit('status-created',res.data.data);
                    this.body = ''
                 })
                 .catch(err => {
                     console.log(err.response.data)
                 })
        }
    }
}
</script>

<style>

</style>