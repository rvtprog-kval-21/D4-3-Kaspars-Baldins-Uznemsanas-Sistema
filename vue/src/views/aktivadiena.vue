<template>
  <div>
    <b-table responsive :items="items" :fields="fields">
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
      items: null,
      media_url: process.env.VUE_APP_MEDIA_URL,
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'personal_code', label: 'P.K.'},
        {key: 'Cipher', label: 'Šifrs'},
        {key: 'marks.language', label: '1. svešvaloda'},
        {key: 'marks.language_mark', label: '1. svešvalodas vērtējums'},
        {key: 'marks.math', label: 'Matemātika'},
        {key: 'marks.latvian', label: 'Latviešu valoda'},
        {key: 'marks.physics', label: 'Fizika'},
        {key: 'marks.chemistry', label: 'Ķīmija'},
        {key: 'marks.informatics', label: 'Informātika'},
        {key: 'average_mark', label: 'Vid. vērtējums.'},
        {key: 'document1', label: 'Apliecības vai atestācijas foto'},
        {key: 'document2', label: 'Sekmju izraksta foto'},
        {key: 'functions', label: 'Funkcijas'},
      ],
    }
  },
  mounted() {
    this.getApplications();

    setInterval(() => {
      this.getApplications();
    }, 5000)
  },
  methods: {
    getApplications() {
      axios.get('/today').then(response => {
        console.log(response);
        response.data.data.forEach(e => {
            e.marks = JSON.parse(e.marks);
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