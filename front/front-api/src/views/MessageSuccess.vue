<template>
    <div class="alert alert-success" role="alert">
        {{ msg }}
    </div>
</template>

<script>
export default {
    name: "MessageSuccess",
    props: {
        msg: String
    }
}
</script>
