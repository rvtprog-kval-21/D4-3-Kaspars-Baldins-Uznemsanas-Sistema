<template>
  <b-container fluid>
    <b-row class="justify-content-md-center">
      <b-col cols="4">
        <b-card class="mb-2 mt-5">
          <label for="login">Lietotājvārds:</label>
          <b-form-input id="login" placeholder="Lietotājvārds"></b-form-input>


          <label for="password">Parole:</label>
          <b-form-input id="password" placeholder="Parole"></b-form-input>
          <b-button size="sm" variant="success" class="mt-2" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
            Pieslēgties
          </b-button>
        </b-card>
      </b-col>
    </b-row>
  </b-container>

</template>

<script>
export default {
name: "Login"
}
</script>

<style scoped>

</style>