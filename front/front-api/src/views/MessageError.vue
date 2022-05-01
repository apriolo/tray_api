<template>
    <div class="alert alert-danger" role="alert">
        {{ msgError }}
    </div>
</template>

<script>
export default {
    name: "MessageError",
    props: {
        msgError: String
    }
}
</script>
