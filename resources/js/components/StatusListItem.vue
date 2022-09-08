<template>
    <div class="card border-0 mb-3 shadow-sm" >
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
        <div class="card-footer p-2 d-flex justify-content-between align-items-center">
            <like-btn
                :status="status"
            ></like-btn>

            <div class="text-secondary">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{ status.likes_count}}</span>
            </div>
        </div>

        <div class="card-footer">
            <div v-for="comment in comments" class="mb-2">
                <img class="rounded shadow-sm float-start me-2" width="34px" 
                    :src="comment.user_avatar" 
                    :alt="comment.user_name">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-2 text-secondary">
                        <a href="#"><strong>{{ comment.user_name }}</strong></a>
                        {{ comment.body }}
                    </div>
                </div>
            </div>
            <form @submit.prevent="addComment" v-if="isAuthenticated">
                <div class="d-flex align-items-center">
                    <img class="rounded shadow-sm float-start me-2" width="34px" 
                        src="https://www.pmfarma.es/images/avatar-equipo.png" 
                        :alt="currentUser.user_name">
                    <div class="input-group">
                        <textarea name="comment" v-model="newComment"
                            class="form-control border-0 shadow-sm"
                            placeholder="Escribe un comentario..."
                            rows="1"
                            required
                        ></textarea>
                        <button dusk="btn-comment" class="btn btn-primary text-light">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    // import axios from 'axios';
    import LikeBtn from './LikeBtn';
    export default {
        components: { LikeBtn },
        props: {
            status: { 
                type: Object,
                required: true
            }
        },
        data() {
            return {
                newComment: '',
                comments: this.status.comments
            }
        },
        methods: {
            addComment() {
                axios.post(`/statuses/${this.status.id}/comments`, {body: this.newComment})
                    .then(res => {
                        this.newComment = '';
                        this.comments.push(res.data.data);
                    })
            }
        }
        
    }
    
</script>