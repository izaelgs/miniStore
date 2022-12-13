<template>
    <div class="container rounded border d-flex justify-content-center align-items-center">
        <h2 v-if="user">Wellcome, {{ user.name }}</h2>
    </div>
</template>

<script>
import Loader from "../components/Loader.vue";
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            loaded: false,
        };
    },

    created() {
    },

    mounted() {
        this.loaded = true;
    },

    methods: {

    },

    computed: {
        ...mapGetters(['user'])
    },

    components: {Loader},

};

</script>
