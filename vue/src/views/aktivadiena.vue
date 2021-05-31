1<template>
  <b-container fluid>
    <b-row>
      <b-col cols="12">
        <b-card
            header="Pieteikumi"
            header-tag="header"
            footer-tag="footer"
            footer=" "
            class="mt-2"
        >
          <b-modal id="modal-1" title="Labot iesniegumu" v-model="show">
            <EditApplication :applicationID="selectedApplication"></EditApplication>

            <template #modal-footer>
              <div class="w-100">
                <b-button
                    variant="primary"
                    size="sm"
                    class="float-right"
                    @click="show = false"
                >
                  Aizvērt
                </b-button>
              </div>
            </template>
          </b-modal>

          <b-table responsive :items="items" :fields="fields">
            <b-tbody>

            </b-tbody>
            <template #cell(marks.language)="row">
              {{ getLanguage(row.item.marks.language) }}
            </template>

            <template #cell(marks.informatics)="row">
              {{ row.item.marks.informatics ? row.item.marks.informatics : 'Nav' }}
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
              <b-button size="sm" variant="success" class="mt-2" :href="'/print/application/'+row.item.id" target="_blank">
                Printēt iesng.
              </b-button>
              <b-button size="sm" variant="success" class="mt-2" :href="'/print/cert/'+row.item.id" target="_blank">
                Printēt apliec.
              </b-button>
              <b-button size="sm" variant="warning" class="mt-2" v-b-modal.modal-sm v-b-modal.modal-1 @click="selectedApplication = row.item.id; show = true">
                Labot/Apskatīt
              </b-button>
              <b-button size="sm" variant="danger" class="mt-2" v-b-modal.modal-sm @click="deleteApplication(row.item.id)">
                Dzēst
              </b-button>
            </template>
          </b-table>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import EditApplication from "../components/EditApplication";

export default {
  components: {
    EditApplication
  },
  data() {
    return {
      items: null,
      selectedApplication: null,
      show: false,
      api: process.env.VUE_APP_API_URL,
      media_url: process.env.VUE_APP_MEDIA_URL,
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'personal_code', label: 'P.K.'},
        {key: 'cipher', label: 'Šifrs'},
        {key: 'marks.language', label: '1. svešval.'},
        {key: 'marks.language_mark', label: '1. svešval. vērt.'},
        {key: 'marks.math', label: 'Mat.'},
        {key: 'marks.latvian', label: 'Lat. val.'},
        {key: 'marks.physics', label: 'Fizika'},
        {key: 'marks.chemistry', label: 'Ķīmija'},
        {key: 'marks.informatics', label: 'Informātika, datorika'},
        {key: 'average_mark', label: 'Vid. vērt.'},
        {key: 'speciality_id', label: 'Pirmā prioritātes specialitāte'},
        {key: 'secondary_speciality_id', label: 'Otrā prioritātes specialitāte'},
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
    deleteApplication(id) {
      axios.delete('/applications/'+id).then(response => {
        console.log(response);
        this.getApplications();
      });
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

<style lang="scss">
.card {
  margin-top: 50px;
  margin-bottom: 50px;
  border: 0px;
  .card-header {
    background-color: #9f2720;
    color: white;
  }
  footer.card-footer {
    background: #28a745;
    padding: 0px;
    height: 5px;
  }
}
</style>