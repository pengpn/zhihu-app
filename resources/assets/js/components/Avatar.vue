<template>
    <!-- vue-image-crop-upload 组件-->
    <!-- 一个组件中必须要把它包裹在一个root根标签下 -->
    <div>
        <my-upload field="img"
                   :width="300"
                   :height="300"
                   url="/upload"
                   :params="params"
                   :headers="headers"
                   :value.sync="show"
                   img-format="png"></my-upload>
        <img width="48px" :src="imgDataUrl">
        <a class="btn" @click="toggleShow">修改头像</a>
    </div>
</template>

<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload/upload-1.vue';
    export default {
        props: ['avatar'],
        data() {//组件中data是个方法，然后return
            return {
                show: false,
                params: {
                    token: '123456798',
                    name: 'avatar'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: this.avatar // the datebase64 url of created image
            }
        },
        components: {
            'my-upload': myUpload
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            }
        },
        events: {
            /**
             * crop success
             *
             * [param] imgDataUrl
             * [param] field
             */
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
                this.imgDataUrl = imgDataUrl;
            },
            /**
             * upload success
             *
             * [param] jsonData   服务器返回数据，已进行json转码
             * [param] field
             */
            cropUploadSuccess(jsonData, field){
                console.log('-------- upload success --------');
                console.log(jsonData);
                console.log('field: ' + field);
            },
            /**
             * upload fail
             *
             * [param] status    server api return error status, like 500
             * [param] field
             */
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }
</script>
