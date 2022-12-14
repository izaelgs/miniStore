<template>
    <div class="card">
        <img :src="product.img_url" class="card-img-top p-4 rounded">
        <div class="card-body d-flex flex-column justify-content-between">
            <router-link
                :to="{ name: 'product', params: { slug: product.name }}"
                class="card-title text-decoration-none mb-4"
                href=""
            >
                <p class="text-black">
                    {{
                        product.name.length > 35 ?
                            product.name.substr(0, 35) + '...' :
                            product.name
                    }}
                </p>
                <p class="card-text fw-bold text-primary">R$ {{ product.price }}</p>
            </router-link>
            <button class="btn btn-primary">Comprar</button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['product']
}

</script>
