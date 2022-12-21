<template>
    <main>
        <div class="position-absolute top-50 start-50 translate-middle text-center">
            <div>
                <div>
                    <Icon
                        icon="mdi:checkbox-multiple-marked-circle-outline"
                        class="text-success"
                        width="50%"
                    />
                    <div class="list-group-item card d-flex flex-row align-items-center justify-content-center">
                        <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl">Order Completed</h1>
                    </div>
                    <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">Your products will be sent to your email address soon.</p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { Icon } from '@iconify/vue';

export default {
    components: {Icon}
}

</script>
