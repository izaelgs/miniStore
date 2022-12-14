<template>
    <div>
        <Loader v-show="!loaded"></Loader>
    </div>
</template>

<script>
import Loader from "../components/Loader.vue";
import Api from "../mixins/Api.vue";

export default {
    data() {
        return {
            loaded: false,
        };
    },

    mounted() {
        this.loaded = true;
    },

    components: {Loader},

    mixins: [Api]
};
</script>
