<template>
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
</template>

<script>
    export default {
        props: {
            status: { 
                type: Object,
                required: true
            }
        },
        methods: {
            like(status) {
                axios.post(`/statuses/${status.id}/likes`)
                .then(res => {
                    status.is_liked = true;
                    status.likes_count++;
                })
                .catch(err => {
                    console.log(err.response.data);
                });
            },
            unlike(status) {
                axios.delete(`/statuses/${status.id}/likes`)
                .then(res => {
                    status.is_liked = false;
                    status.likes_count--;
                })
                .catch(err => {
                    console.log(err.response.data);
                });
            }
        }
    }
</script>