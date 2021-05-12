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

    <b-table responsive :items="items" :fields="fields" :filter="filter" :no-provider-filtering="true">

      <template #cell(marks.language)="row">
        {{ getLanguage(row.item.marks.language) }}
      </template>

      <template #cell(average_mark)="row">
        {{ getAvgMark(row.item.marks) }}
      </template>

      <template #cell(document1)="row">
        <a :href="media_url+'/documents/'+row.item.document1" target="_blank">Atvērt failu</a>
      </template>

      <template #cell(document2)="row">
        <a :href="media_url+'/documents/'+row.item.document2" target="_blank">Atvērt failu</a>
      </template>

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
      media_url: process.env.VUE_APP_MEDIA_URL,
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'personal_code', label: 'P.K.'},
        {key: 'education_code', label: 'Izglītības kods'},
        {key: 'lang', label: '1. svešvaloda'},
        {key: 'marks.language_mark', label: '1. svešvalodas vērtējums'},
        {key: 'marks.math', label: 'Matemātika'},
        {key: 'marks.latvian', label: 'Latviešu valoda'},
        {key: 'marks.physics', label: 'Fizika'},
        {key: 'marks.chemistry', label: 'Ķīmija'},
        {key: 'marks.informatics', label: 'Informātika'},
        {key: 'marks.avg', label: 'Vid. vērtējums.'},
        {key: 'document1', label: 'Apliecības vai atestācijas foto'},
        {key: 'document2', label: 'Sekmju izraksta foto'},
        {key: 'Cipher', label: 'Šifrs'},
        {key: 'group', label: 'Grupa'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      items: null,
    }
  },
  mounted() {
    this.getApplications();
  },
  methods: {
    getApplications() {
      axios.get('/applications').then(response => {
        response.data.data.forEach(e => {
            e.marks = JSON.parse(e.marks);
            e.lang = this.getLanguage(e.marks.language);
            e.marks.avg = this.getAvgMark(e.marks);
        });

        this.items = response.data.data;
        console.log(this.items);
      })
    },
    getLanguage(language) {
      switch(language) {
        case 'english':
          return 'Angļu';
        case 'french':
          return 'Franču';
        case 'german':
          return 'Vācu';
      }
    },
    getAvgMark(marks) {
      delete marks.language;

      if(marks.informatics == null) {
        delete marks.informatics;
      }

      let data = Object.values(marks)
      let sum = 0;

      data.forEach(e => {
        sum += parseInt(e);
      });

      return sum/data.length;
    }
  },
}
</script>