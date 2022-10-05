<template>
    <div class="px-4">
        <top-menu />
        <div class="mt-4 p-2">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import TopMenu from "@/components/top-menu";
</script>

<style scoped lang="scss">

</style>
