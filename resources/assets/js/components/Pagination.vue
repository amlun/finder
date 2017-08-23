<template>
    <div class="layout-padding row justify-center">
        <div style="width:900px; max-width: 90vw; text-align: center;">
            <q-pagination v-model="page" :max="maxPage"/>
        </div>
    </div>
</template>

<script>
    import {
        QPagination
    } from 'quasar-framework'

    export default {
        components: {
            QPagination
        },
        data() {
            return {
                page: curPage,
                maxPage: maxPage
            }
        },
        watch: {
            page: function (val) {
                window.location.href = '?page=' + val;
            }
        }
    }
</script>