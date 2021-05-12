<template>
  <div>
    <b-col lg="6" class="my-1">
      <b-form-group
          label="Meklēšana"
          label-for="filter-input"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          class="mb-0"
      >
        <b-input-group size="sm">
          <b-form-input
              id="filter-input"
              v-model="filter"
              type="search"
              placeholder="Meklēt"
          ></b-form-input>
        </b-input-group>
      </b-form-group>
    </b-col>

    <b-table responsive :items="items" :fields="fields" :filter="filter" :tbody-tr-class="rowClass">
      <template #cell(functions)="row">
        <b-button size="sm" variant="success" class="mt-2" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
          Printēt iesng.
        </b-button>
        <b-button size="sm" variant="success" class="mt-2" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
          Printēt apliec.
        </b-button>
        <b-button size="sm" variant="warning" class="mt-2" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
          Labot/Apskatīt
        </b-button>
        <b-button size="sm" variant="danger" class="mt-2" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
          Dzēst
        </b-button>

      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: null,
      fields: [
        {key: 'number', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'pk', label: 'P.K.'},
        {key: 'education_code', label: 'Izglītības kods'},
        {key: 'language', label: '1. svešvaloda'},
        {key: 'language_mark', label: '1. svešvalodas vērtējums'},
        {key: 'mathematics', label: 'Matemātika'},
        {key: 'latvian_language', label: 'Latviešu valoda'},
        {key: 'physics', label: 'Fizika'},
        {key: 'chemistry', label: 'Ķīmija'},
        {key: 'informatics', label: 'Informātika'},
        {key: 'average_mark', label: 'Vid. vērtējums.'},
        {key: 'photo_of_attestation', label: 'Apliecības vai atestācijas foto'},
        {key: 'marks_photo', label: 'Sekmju izraksta foto'},
        {key: 'Cipher', label: 'Šifrs'},
        {key: 'group', label: 'Grupa'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      items: [
        { "number": '--', "name": '--', "surname": '--',
          "pk": '--',"education_code": '--', "language": '--', "language_mark": '--',
          "mathematics": '--', "latvian_language": '--', "physics": '--',
          "chemistry": '--', "informatics": '--',
          "average_mark": '--', "photo_of_attestation": '--',
          "marks photo": '--', "Cipher": '--', "group": '--', "functions": '--'},

      ]
    }
  }
}
</script>