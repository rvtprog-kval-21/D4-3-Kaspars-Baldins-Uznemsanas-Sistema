<template>
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

          <b-row>

            <b-col cols="4" class="mb-3">
              <b-form-group
                  id="fieldset-1"
                  label="Meklēt pēc šifra"
                  label-for="filter-input"
                  label-cols-sm="3"
                  label-align-sm="right"
                  label-size="sm"
                  class="mb-0"
              >
                <b-input-group size="sm">
                  <b-form-select id="filter-input" v-model="filter" :options="specialities"></b-form-select>
                </b-input-group>
              </b-form-group>
            </b-col>

            <b-col cols="8">
              <b-form-group
                  label="Meklēšana"
                  label-for="filter2-input"
                  label-cols-sm="3"
                  label-align-sm="right"
                  label-size="sm"
                  class="mb-0"
              >
                <b-input-group size="sm">
                  <b-form-input
                      id="filter2-input"
                      v-model="filter"
                      type="search"
                      placeholder="Meklēt"
                  ></b-form-input>
                </b-input-group>
              </b-form-group>
            </b-col>
          </b-row>


          <b-table responsive :items="items" :fields="fields" :filter="filter" :no-provider-filtering="true">

            <template #cell(marks.language)="row">
              {{ getLanguage(row.item.marks.language) }}
            </template>

            <template #cell(average_mark)="row">
              {{ getAvgMark(row.item.marks) }}
            </template>

            <template #cell(marks.informatics)="row">
              {{ row.item.marks.informatics ? row.item.marks.informatics : 'Nav' }}
            </template>

            <template #cell(group_name)="row">
              {{ row.item.group_name ? row.item.group_name : 'Nav' }}
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
      filter: null,
      media_url: process.env.VUE_APP_MEDIA_URL,
      api: process.env.VUE_APP_API_URL,
      selectedApplication: null,
      show: false,
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'personal_code', label: 'P.K.'},
        {key: 'education_code', label: 'Izg. kods'},
        {key: 'lang', label: '1. svešval.'},
        {key: 'marks.language_mark', label: '1. svešval. vērt.'},
        {key: 'marks.math', label: 'Mat.'},
        {key: 'marks.latvian', label: 'Lat. val.'},
        {key: 'marks.physics', label: 'Fizika'},
        {key: 'marks.chemistry', label: 'Ķīmija'},
        {key: 'marks.informatics', label: 'Informātika, datorika'},
        {key: 'marks.avg', label: 'Vid. vērt.'},
        {key: 'branch', label: 'Filiāle'},
        {key: 'speciality_id', label: 'Pirmā prioritātes specialitāte'},
        {key: 'secondary_speciality_id', label: 'Otrā prioritātes specialitāte'},
        {key: 'document1', label: 'Apliec. vai atest. foto'},
        {key: 'document2', label: 'Sekmju izraksta foto'},
        {key: 'cipher', label: 'Šifrs'},
        {key: 'group_name', label: 'Grupa'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      items: null,
      specialities: [],
    }
  },
  mounted() {
    this.getApplications();
    this.getSpecialities();
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
    getSpecialities() {
      axios.get('/specialities').then(response => {
        this.specialities = response.data.data;

        this.specialities.forEach(e => {
          e.value = e.code;
          e.text = e.code;
        });

        this.specialities.unshift({ value: null, text: '--' });
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
    },
  }
}
</script>