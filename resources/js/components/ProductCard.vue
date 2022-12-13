<template>
    <div class="card">
        <img :src="product.img_url" class="card-img-top px-2" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">R$ {{ product.price }}</p>
            <button class="btn btn-primary">Comprar</button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['product']
}

</script>
