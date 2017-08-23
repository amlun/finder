<template>
    <div class="layout-padding row justify-center">
        <div style="width: 600px; max-width: 90vw;">
            <p class="caption">Gallery</p>
            <q-gallery-carousel infinite autoplay dots fullscreen :src="gallery"/>
        </div>
    </div>
</template>

<script>
    import {
        QGalleryCarousel
    } from 'quasar-framework'

    export default {
        components: {
            QGalleryCarousel
        },
        data() {
            return {
                gallery: photos
            }
        }
    }
</script>