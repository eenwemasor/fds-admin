<template>
    <div>
        <div class="row g-0">
            <div class="col-sm-6 col-md-8"><h1>Dashboard</h1></div>
            <div class="col-6 col-md-4">
                <Setting />
            </div>
        </div>
    </div>
</template>

<script>
import Setting from "./settings/Index.vue"
export default {
    name:"Dashboard",
    components:{Setting}

};
</script>

<style></style>
