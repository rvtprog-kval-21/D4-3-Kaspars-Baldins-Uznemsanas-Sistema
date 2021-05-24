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

          <b-table responsive :items="statistics" :fields="fields">

            <template #cell(created_at)="row">
              {{ row.item.created_at.split(' ')[0] }}
            </template>

          </b-table>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      statistics: null,
      fields: [
        {key: 'name', label: 'Kvalifikācija'},
        {key: 'branches', label: 'Filiāle'},
        {key: 'created_at', label: 'Datums'},
        {key: 'application_count', label: 'Pieteikumu skaits'},
      ],
    }
  },
  mounted() {
    this.getStatistics();
  },
  methods: {
    getStatistics() {
      axios.get('/statistics').then(response => {
        this.statistics = response.data.data;
      });
    }
  },
}
</script>

<style scoped>

</style>