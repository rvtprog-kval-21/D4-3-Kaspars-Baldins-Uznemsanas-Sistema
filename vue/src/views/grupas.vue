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
        name: '',
        speciality_id: '',
      },
      fields: [
        {key: 'id', label: 'Nr.'},
        {key: 'name', label: 'Grupas nosaukums'},
        {key: 'qual', label: 'Klasifikācija'},
        {key: 'speciality', label: 'Specialitāte'},
        {key: 'functions', label: 'Funkcijas'},
      ],
      items: [],
      selected: null,
      options: []
    }
  },
  mounted() {
    this.getOptions();
    this.getGroupData();
  },
  methods: {
    createGroup(event) {
      event.preventDefault()
      axios.post('/groups', this.form).then(response => {
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
  },
}
</script>

<style scoped>

</style>