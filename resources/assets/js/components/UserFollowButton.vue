<template>
    <button
            class="btn btn-default"
            :class="{'btn-success' : followed}"
            v-text="text"
            @click="follow"
    ></button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            axios.get('/api/user/followers/'+ this.user).then(response =>{
                console.log(response.data)
                this.followed = response.data.followed
            })
        },
        data() {
            return {
                followed: false,
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注':'关注他'
            }
        },
        methods: {
            follow() {
                axios.post('/api/user/follow',{'user':this.user}).then(response =>{
                    this.followed = response.data.followed;
                })
            }
        }
    }
</script>
