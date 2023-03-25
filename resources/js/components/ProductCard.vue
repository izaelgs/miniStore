<template>
    <div class="card">
        <router-link
            :to="{ name: 'product', params: { slug: product.id }}"
            class="text-decoration-none"
        >
            <img :src="product.img_url" class="card-img-top p-4 rounded">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="card-title mb-4">                
                    <p class="text-dark fw-bold">
                        {{
                            product.name.length > 35 ?
                                product.name.substr(0, 35) + '...' :
                                product.name
                        }}
                    </p>
                    <p class="card-text fw-bold text-primary">{{ product.price }}</p>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>

export default {
    props: ['product']
}

</script>
