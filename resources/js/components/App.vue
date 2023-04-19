<template>
<div class="container-fluid d-flex justify-content-center align-items-center">
    <img src="images/background/flag.jpg" alt="Background" class="bg-image img-fluid">
    <FormComponent></FormComponent>
</div>

</template>

<script>
import FormComponent from "./FormComponent.vue";
export default {
    name: "App",
    components: {FormComponent}
}
</script>

<style scoped>
.align-items-center{
    height: 100vh;
}
.bg-image{
    height: 100vh;
    width: 100vw;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}
</style>
