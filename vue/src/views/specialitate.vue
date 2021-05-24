<template>
  <div>
    <b-container fluid>
      <b-row>
        <b-col cols="12">
          <b-card
              header="Grupas"
              header-tag="header"
              footer-tag="footer"
              footer=" "
              class="mt-2"
          >
            <b-row>
              <b-col cols="4">
                <h2>Specialitātes pievienošana:</h2>
                <b-form @submit="createSpeciality">
                  <b-form-group
                      id="input-group-1"
                      label="Specialitātes nosaukums:"
                      label-for="input-1"
                  >
                    <b-form-input id="input-default" v-model="form.speciality"></b-form-input>
                  </b-form-group>

                  <b-form-group id="input-group-2" label="Kvalifikācijas nosaukums:" label-for="input-2">
                    <b-form-input id="input-default" v-model="form.name"></b-form-input>
                  </b-form-group>

                  <b-form-group id="input-group-3" label="Kods:" label-for="input-3">
                    <b-form-input v-model="form.code" :options="options"></b-form-input>
                  </b-form-group>

                  <b-form-group id="input-group-3" label="Filiāle:" label-for="input-3">
                    <b-form-select v-model="form.branch_id" :options="branches"></b-form-select>
                  </b-form-group>

                  <b-form-group id="input-group-4" label="Klase:" label-for="input-4">
                    <b-form-select v-model="form.class" :options="options"></b-form-select>
                  </b-form-group>

                  <b-button type="submit" variant="success">Pievienot</b-button>
                </b-form>

              </b-col>

              <b-col cols="8">
                <b-table responsive :items="items" :fields="fields">
                  <template #cell(class)="row">
                    {{ row.item.class == 1 ? 'Pēc 9. klases' : 'Pēc 12. klases' }}
                  </template>

                  <template #cell(functions)="row">
                    <b-button size="sm" variant="success" @click="$router.push({ name: 'DocumentView', params: {id: row.item.id} })" class="mr-1">
                      Printēt
                    </b-button>
                    <b-button size="sm" variant="danger" v-b-modal.modal-sm @click="archiveItem(row.item.id, row.index)">
                      Dzēst
                    </b-button>
                  </template>
                </b-table>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        speciality: '',
        name: '',
        class: null,
        code: '',
        branch_id: null,
      },
      branches: [],
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Kvalifikācija'},
        {key: 'class', label: 'Klase'},
        {key: 'branch', label: 'Filiāle'},
        {key: 'code', label: 'Kods'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      items: [],
      selected: null,
      options: [
        { value: null, text: '-' },
        { value: 1, text: 'Pēc 9. klase' },
        { value: 2, text: 'Pēc 12. klase' }
      ]

    }
  },
  mounted() {
    this.getBranches();
    this.getSpecialityData();
  },
  methods: {
    createSpeciality(event) {
      event.preventDefault()

      axios.post('/specialities', this.form).then(response => {
        this.getSpecialityData();
      });
    },
    getSpecialityData() {
      axios.get('/specialities').then(response => {
        this.items = response.data.data;
      });
    },
    getBranches() {
      axios.get('/branches').then(response => {
        this.branches = response.data.data;
      })
    }
  },
}
</script>

<style scoped>

</style>