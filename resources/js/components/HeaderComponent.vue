<template>

    <div class="header">
        <div class="container">
            <div class="header__links">
                <a class="link__item" href="#">LINK</a>
                <a class="link__item" href="#">LINK</a>
            </div>
            <div>
                <div>NAME</div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "HeaderComponent"
}
</script>

<style scoped>
.header{
    background-color: darkorange;
    height: 60px;
    align-items: center;
    display: flex;
}
.container {
    display: flex;
    justify-content: space-between;
}

.link__item {
    margin-right: 20px;
    color: black;
    text-decoration: none;

}
.link__item:hover {
    color: white;
}

</style>
