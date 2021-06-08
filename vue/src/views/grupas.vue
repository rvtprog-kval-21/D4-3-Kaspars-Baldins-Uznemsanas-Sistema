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
                <h2>Grupas pievienošana:</h2>
                <b-form @submit="createGroup">

                  <b-form-group id="input-group-2" label="Filiāle:" label-for="input-2">
                    <b-form-select v-model="form.branch_id" :options="branches"></b-form-select>
                  </b-form-group>

                  <b-form-group
                      id="input-group-1"
                      label="Grupas nosaukums:"
                      label-for="input-1"
                  >

                    <b-form-input id="input-default" v-model="form.name"></b-form-input>
                  </b-form-group>

                  <b-form-group id="input-group-2" label="Specialitate:" label-for="input-2">
                    <b-form-select v-model="form.speciality_id" :options="options"></b-form-select>
                  </b-form-group>

                  <b-button type="submit" variant="success">Pievienot</b-button>
                </b-form>

              </b-col>

              <b-col cols="8">
                <b-table responsive :items="items" :fields="fields">
                  <template #cell(functions)="row">
<!--                    <b-button size="sm" variant="success" class="mt-2" :href="'/print/dir/'+row.item.id" target="_blank">-->
<!--                      Printēt iesng.-->
<!--                    </b-button>-->
                    <b-button size="sm" variant="danger" class="mt-2" v-b-modal.modal-sm @click="deleteGroup(row.item.id)">
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
        name: '',
        branch_id: '',
        speciality_id: '',
      },
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Grupas nosaukums'},
        {key: 'branch', label: 'Filiāle'},
        {key: 'qual', label: 'Klasifikācija'},
        {key: 'speciality', label: 'Specialitāte'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      branches: [],
      items: [],
      selected: null,
      options: []
    }
  },
  mounted() {
    this.getOptions();
    this.getGroupData();
    this.getBranches();
  },
  methods: {
    createGroup(event) {
      event.preventDefault()
      axios.post('/groups', this.form).then(response => {
        this.getGroupData();
      });
    },
    deleteGroup(id) {
      axios.delete('/groups/'+id).then(response => {
        console.log(response);
        this.getGroupData();
      });
    },
    getGroupData() {
      axios.get('/groups').then(response => {
        this.items = response.data.data;
      });
    },
    getOptions() {
      axios.get('/specialities').then(response => {
        response.data.data.forEach(e => {
          e.text = (e.class === '1' ? '[Pēc 9. klases] ' : '[Pēc 12. klases] ') + e.speciality + ' - ' + e.name;
          e.value = e.id;
        })

        this.options = response.data.data;

      })
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