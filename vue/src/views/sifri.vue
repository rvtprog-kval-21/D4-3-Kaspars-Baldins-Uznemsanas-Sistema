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
              <b-dropdown-item>A-</b-dropdown-item>
              <b-dropdown-item>ATK-</b-dropdown-item>
              <b-dropdown-item>AV-</b-dropdown-item>
              <b-dropdown-item>B-</b-dropdown-item>
              <b-dropdown-item>BG-</b-dropdown-item>
              <b-dropdown-item>DD-</b-dropdown-item>
              <b-dropdown-item>DP-</b-dropdown-item>
              <b-dropdown-item>DT-</b-dropdown-item>
              <b-dropdown-item>EA</b-dropdown-item>
              <b-dropdown-item>ET</b-dropdown-item>
              <b-dropdown-item>G-</b-dropdown-item>
              <b-dropdown-item>GK</b-dropdown-item>
              <b-dropdown-item>GL-</b-dropdown-item>
              <b-dropdown-item>KD-</b-dropdown-item>
              <b-dropdown-item>KT-</b-dropdown-item>
              <b-dropdown-item>L</b-dropdown-item>
              <b-dropdown-item>M-</b-dropdown-item>
              <b-dropdown-item>MG-</b-dropdown-item>
              <b-dropdown-item>N-</b-dropdown-item>
              <b-dropdown-item>PI-</b-dropdown-item>
              <b-dropdown-item>PRT-</b-dropdown-item>
              <b-dropdown-item>S-</b-dropdown-item>
              <b-dropdown-item>TA</b-dropdown-item>
              <b-dropdown-item>VA-</b-dropdown-item>
              <b-dropdown-item>VAV-</b-dropdown-item>
              <b-dropdown-item>VB-</b-dropdown-item>
              <b-dropdown-item>VDD-</b-dropdown-item>
              <b-dropdown-item>VET</b-dropdown-item>
              <b-dropdown-item>VL-</b-dropdown-item>
              <b-dropdown-item>VPIT</b-dropdown-item>
              <b-dropdown-item>VPRT</b-dropdown-item>
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