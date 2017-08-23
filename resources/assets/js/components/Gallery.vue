<template>
    <div class="layout-padding row justify-center">
        <div style="width: 500px; max-width: 90vw;">
            <p class="caption">Gallery</p>
            <q-gallery :src="gallery"/>
            <q-gallery-carousel autoplay infinite fullscreen dots actions :src="gallery"/>
            <q-pagination v-model="page" :max="maxPage"/>
        </div>
    </div>
</template>

<script>
    import {
        QPagination,
        QGallery,
        QGalleryCarousel
    } from 'quasar-framework'

    export default {
        components: {
            QPagination,
            QGallery,
            QGalleryCarousel
        },
        data() {
            return {
                gallery: photos,
                page: curPage,
                maxPage: maxPage
            }
        },
        watch: {
            page: function (curVal, oldVal) {
                window.location.href = '?page=' + curVal;
            }
        }
    }
</script>