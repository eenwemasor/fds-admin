<template>
    <div
        :class="`spinner-border text-${color} spinner-border-${size}`"
        role="status"
    ></div>
</template>

<script>
export default {
    name: "Loader",
    props: {
        size: {
            type: String,
            default: () => "sm",
        },
        color: {
            type: String,
            default: () => "light",
        },
    },
};
</script>

<style></style>
