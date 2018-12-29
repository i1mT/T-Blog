<template>
    <div class="mood-item">
        <!-- 时间 -->
        <h2 class="mood-title">
            {{time}}
            <!-- <span class="expend-btn" @click="expendContent">{{expendText}}</span> -->
        </h2>
        <!-- 内容 注意：下方pre不能展开 -->
        <pre v-if="expend">{{content}}<template v-if="content.length > brief.length">
<span class="expend-btn-inline" @click="expendContent">{{expendText}}</span></template></pre>
        <pre v-else>{{brief}}<template v-if="content.length > brief.length"> ...<span class="expend-btn-inline" @click="expendContent">{{expendText}}</span></template></pre>
        <!-- 展开收起按钮 -->
        <!-- 显示图片 -->
        <div v-if="expend" class="images">
            <img v-for="(item, i) in image" @click="showImage(item, i)" :key="i" :src="item">
        </div>
        <div v-else class="image-brief">
            <img v-if="image.length >= 1" :src="image[0]">
        </div>
        <image-viewer :src="viewImage" :show="imageViewerShow" @close="closeImageViewer"></image-viewer>
    </div>
</template>

<script>
import ImageViewer from "../Com/ImageViewer"
export default {
    data() {
        return {
            expend: false,
            expendText: '展开',
            viewImage: '',
            imageViewerShow: false,
        }
    },
    methods: {
        showImage(item, i) {
            console.log(1)
            this.viewImage = item
            this.imageViewerShow = true
        },
        closeImageViewer () {
            this.imageViewerShow = false
        },
        expendContent () {
            this.expend = !this.expend
        }
    },
    props: ['content', 'brief', 'time', 'image'],
    watch: {
        expend (now, old) {
            if(now == true) {
                this.expendText = '收起'
            } else {
                this.expendText = '展开'
            }
        }
    },
    components: {
        ImageViewer,
    }
}
</script>

<style scoped>
span.expend-btn {
    margin-left: 1rem;
    background-color: #d9d9d9;
    padding: .3rem 1.2rem;
    border-radius: 3px;
    font-size: 14px;
    cursor: pointer;
}
span.expend-btn-inline {
    margin-left: 0rem;
    color: rgb(26, 69, 189);
    border-radius: 3px;
    font-size: 14px;
    cursor: pointer;
}
.markdown-body .mood-item pre {
    background: none;
    padding: 0;
    font-size: 1.6rem;
    margin-bottom: 1.6rem;
    font-family: Exo-regular,'-apple-system','Open Sans',HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue','Hiragino Sans GB','Microsoft YaHei',Helvetica,Arial,sans-serif;
}
.markdown-body .mood-item .images img {
    width: 50%;
    padding: 0 .3rem;
    padding-left: 0;
    padding-right: .8rem;
    margin: 0;
    box-sizing: border-box;
    line-height: 1;
    cursor: pointer;
}
.markdown-body .mood-item .image-brief img {
    max-height: 50rem;
}
</style>
