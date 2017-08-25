<template>
    <div class="layout-padding row justify-center">
        <div style="width: auto; max-width: 90vw;">
            <p class="caption">Gallery</p>
            <q-gallery :src="gallery" :width="width"/>
        </div>
    </div>
</template>

<script>
    import {
        QGallery
    } from 'quasar-framework'

    export default {
        components: {
            QGallery
        },
        data() {
            return {
                gallery: photos,
                width: "240px"
            }
        }
    }
</script>