<template>
    <div >
        <div v-show="loading">
            <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
        </div>



        <button
                v-if="!loading"
                class="btn btn-default"
                :class="{'btn-success' : followed}"
                v-text="text"
                @click="follow"
        ></button>
    </div>
</template>

<script>
    export default {
        props:['question'],
        mounted() {
            axios.post('/api/question/follower',{'question':this.question}).then(response =>{
                this.followed = response.data.followed
                this.loading = false
            })
        },
        data() {
            return {
                followed: false,
                loading: true,
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注':'关注该问题'
            }
        },
        methods: {
            follow() {
                axios.post('/api/question/follow',{'question':this.question}).then(response =>{
                    this.followed = response.data.followed;
                })
            }
        }
    }
</script>
