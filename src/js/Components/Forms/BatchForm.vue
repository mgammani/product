<template>
    <div class="row">
        <div class="input-field col s12">
            <input id="batch_name" type="text" class="validate" v-model="batch_name" required>
            <label for="batch_name">Batch Name</label>
        </div>
        <div class="input-field col s12">
            <input id="created_by" type="text" class="validate" v-model="created_by" required>
            <label for="created_by">Created By</label>
        </div>
    </div>
</template>
<script>
    export default {
        name: "BatchForm",
        props:['batch_name','created_by']
    }
</script>

<style scoped>

</style>