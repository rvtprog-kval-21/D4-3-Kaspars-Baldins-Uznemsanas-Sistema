<template>
  <div>
    <b-container fluid>
        <b-col cols="2">
<!--          <b-form-group label-cols-md="3" class="mb-2 mt-2" label="Šifri">-->
<!--          <b-form-select v-model="selected" :options="options"></b-form-select>-->
      <div>
        <b-input-group>
          <template #prepend>
            <b-dropdown  text="Šifri" variant="info">
              <b-dropdown-item>_</b-dropdown-item>
            </b-dropdown>
          </template>

          <b-input-group-append>
            <b-button size="sm" text="button" variant="success">Atlasīt</b-button>
          </b-input-group-append>
        </b-input-group>
      </div>
        </b-col>
    </b-container>
      <b-table responsive :items="items" :fields="fields" :tbody-tr-class="rowClass">
      </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {

      fields: [
        {
          key: 'number', label: 'Nr.',
          sortable: false
        },
        {
          key: 'name', label: 'Vārds.',
          sortable: false
        },
        {
          key: 'surname', label: 'Uzvārds',
          sortable: false
        },
        {
          key: 'pk', label: 'P.K.',
          sortable: false
        },
        {
          key: 'language', label: '1. svešvaloda',
          sortable: false
        },
        {
          key: 'language_mark', label: '1. svešvalodas vērtējums',
          sortable: false
        },
        {
          key: 'mathematics', label: 'Matemātika',
          sortable: false
        },
        {
          key: 'latvian_language', label: 'Latviešu valoda',
          sortable: false
        },
        {
          key: 'physics', label: 'Fizika',
          sortable: false
        },
        {
          key: 'chemistry', label: 'Ķīmija',
          sortable: false
        },
        {
          key: 'informatics', label: 'Informātika',
          sortable: false
        },
        {
          key: 'average_mark', label: 'Vid. Vērt.',
          sortable: true
        },
        {
          key: 'Cipher', label: 'Šifrs',
          sortable: true
        },
        {
          key: 'group', label: 'Grupa',
          sortable: false
        },
        {
          key: 'photo_of_attestation', label: 'Apliecības vai atestācijas foto',
          sortable: false
        },
        {
          key: 'marks photo', label: 'Sekmju izraksta foto',
          sortable: false
        },
        {
          key: 'functions', label: 'Funkcijas',
          sortable: false
        },
      ],

      items: [
        { "number": '--', "name": '--', "surname": '--',
          "pk": '--', "language": '--', "language_mark": '--',
          "mathematics": '--', "latvian_language": '--', "physics": '--',
          "chemistry": '--', "informatics": '--', "average_mark": '--',
          "Cipher": '--', "group": '--', "photo_of_attestation": '--',
          "marks photo": '--', "functions": '--'},

      ],

      selected: null,
      options: [
        { value: 'e', text: 'eeeee' },
        { value: '', text: '' },
        { value: '', text: '' },
        { value: '', text: '' }
      ]
    }
  }
}
</script>

<style scoped>

</style>