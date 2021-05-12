<template>
  <div>
    <b-container fluid>
      <b-row>

        <b-col cols="4">
          <h2>Specialitātes pievienošana:</h2>
          <div>
            <b-form-group label="Specialitātes nosaukums:" label-for="input-default">
              <b-form-input id="input-default"></b-form-input>
            </b-form-group>
          </div>
          <div>
            <b-form-group label="Kvalifikācijas nosaukums:" label-for="input-default">
              <b-form-input id="input-default"></b-form-input>
            </b-form-group>
          </div>
          <div>
            <label for="selected">Klase:</label>
            <b-form-select v-model="selected" :options="options"></b-form-select>
          </div>
        </b-col>

        <b-col cols="8">
          <b-table responsive :items="items" :fields="fields" :tbody-tr-class="rowClass">
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
    </b-container>
  </div>
</template>
<script>
export default {
  data() {
    return {

      fields: [
        {key: 'number', label: 'Nr.'},
        {key: 'classification_name', label: 'Klasifikācijas nosaukums'},
        {key: 'classification', label: 'Klasifikācija'},
        {key: 'specialty', label: 'Specialitāte'},
        {key: 'functions', label: 'Funkcijas'},
      ],

      items: [
        { "number": '1.',
          "classification_name": 'A1-1',
          "classification": 'Automehāniķis',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '2.',
          "classification_name": 'A1-2',
          "classification": 'Automehāniķis',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '3.',
          "classification_name": 'ATK1',
          "classification": 'Transportlīdzekļu krāsotājs',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '4.',
          "classification_name": 'AV1',
          "classification": 'Autovirsbūvju remontatslēdznieks',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '5.',
          "classification_name": 'B1',
          "classification": 'Klientu apkalpošanas speciālists',
          "specialty": 'Administratīvie un sekretāra pakalpojumi',
          "functions": ''},
        { "number": '6.',
          "classification_name": 'BG1',
          "classification": 'Būvizstrādājumu galdnieks',
          "specialty": 'Kokizstrādājumu izgatavošana',
          "functions": ''},
        { "number": '7.',
          "classification_name": 'DD1',
          "classification": 'Digitālās drukas operators',
          "specialty": 'Poligrāfija un izdevējdarbība',
          "functions": ''},
        { "number": '8.',
          "classification_name": 'DK1-1',
          "classification": 'Datorsistēmu tehniķis',
          "specialty": 'Datorsistēmas, datu bāzes un datortīkli',
          "functions": ''},
        { "number": '9.',
          "classification_name": 'DP1-1',
          "classification": 'Programmēšanas tehniķis',
          "specialty": 'Programmēšana',
          "functions": ''},
        { "number": '10.',
          "classification_name": 'DP1-2',
          "classification": 'Programmēšanas tehniķis',
          "specialty": 'Programmēšana',
          "functions": ''},
        { "number": '11.',
          "classification_name": 'DP1-3',
          "classification": 'Programmēšanas tehniķis',
          "specialty": 'Programmēšana',
          "functions": ''},
        { "number": '12.',
          "classification_name": 'DP1-4',
          "classification": 'Programmēšanas tehniķis',
          "specialty": 'Programmēšana',
          "functions": ''},
        { "number": '13.',
          "classification_name": 'DT1-1',
          "classification": 'Datorsistēmu tehniķis',
          "specialty": 'Datorsistēmas, datu bāzes un datortīkli',
          "functions": ''},
        { "number": '14.',
          "classification_name": 'DT1-2',
          "classification": 'Datorsistēmu tehniķis',
          "specialty": 'Datorsistēmas, datu bāzes un datortīkli',
          "functions": ''},
        { "number": '15.',
          "classification_name": 'EA1',
          "classification": 'Atjaunojamās enerģētikas tehniķis',
          "specialty": 'Enerģētika un elektrotehnika',
          "functions": ''},
        { "number": '16.',
          "classification_name": 'ET1',
          "classification": 'Elektrotehniķis',
          "specialty": 'Enerģētika un elektrotehnika',
          "functions": ''},
        { "number": '17.',
          "classification_name": 'G1',
          "classification": 'Grāmatvedis',
          "specialty": 'Grāmatvedība',
          "functions": ''},
        { "number": '18.',
          "classification_name": 'GK1',
          "classification": 'Reklāmas pakalpojumu komercdarbinikes',
          "specialty": 'Komerczinības',
          "functions": ''},
        { "number": '19.',
          "classification_name": 'GL1-1',
          "classification": 'Loģistikas darbinieks',
          "specialty": 'Telemehānika un loģistika',
          "functions": ''},
        { "number": '20.',
          "classification_name": 'GL1-2',
          "classification": 'Loģistikas darbinieks',
          "specialty": 'Telemehānika un loģistika',
          "functions": ''},
        { "number": '21.',
          "classification_name": 'KD1',
          "classification": 'Datorizētu kokapstrādes iekārtu operators',
          "specialty": 'Kokizstrādājumu izgatavošana',
          "functions": ''},
        { "number": '22.',
          "classification_name": 'KT1',
          "classification": 'Koka izstrādājumu ražošanas tehniķis',
          "specialty": 'Kokizstrādājumu izgatavošana',
          "functions": ''},
        { "number": '23.',
          "classification_name": 'L1',
          "classification": 'Lokomotīvju saimniecības tehniķis',
          "specialty": 'Dzelzceļa transports',
          "functions": ''},
        { "number": '24.',
          "classification_name": 'M1',
          "classification": 'Mašīnbūves tehniķis',
          "specialty": 'Inženiermehānika, mehānika un mašīnbūves tehnoloģija',
          "functions": ''},
        { "number": '25.',
          "classification_name": 'MG1',
          "classification": 'Mēbeļu galdnieks',
          "specialty": 'Kokizstrādājumu izgatavošana',
          "functions": ''},
        { "number": '26.',
          "classification_name": 'N1',
          "classification": 'Iespieddarbu noformējuma tehniķis',
          "specialty": 'Poligrāfija un izdevējdarbība',
          "functions": ''},
        { "number": '27.',
          "classification_name": 'PIT1',
          "classification": 'Poligrāfijas iekārtu tehniķis',
          "specialty": 'Poligrāfija un izdevējdarbība',
          "functions": ''},
        { "number": '28.',
          "classification_name": 'PRT1',
          "classification": 'Poligrāfijas ražošanas tehniķis',
          "specialty": 'Poligrāfijas ražošanas tehnoloģijas un izstrādājumu izgatavošana',
          "functions": ''},
        { "number": '29.',
          "classification_name": 'S1',
          "classification": 'Materiālu ķīmijas tehniķis',
          "specialty": 'Ķīmijas tehnoloģijas',
          "functions": ''},
        { "number": '30.',
          "classification_name": 'TA1',
          "classification": 'Dzelzceļa transporta automātikas, telemehānikas un sakaru tehniķis',
          "specialty": 'Dzelzceļa pakalpojumi',
          "functions": ''},
        { "number": '31.',
          "classification_name": 'TP1',
          "classification": 'Dzelzceļa transporta pārvadājumu organizācijas un kustības drošības tehniķis',
          "specialty": 'Dzelzceļa pakalpojumi',
          "functions": ''},
        { "number": '32.',
          "classification_name": 'VA1',
          "classification": 'Automehāniķis',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '33.',
          "classification_name": 'VAV1',
          "classification": 'Autovirsbūvju remontatslēdznieks',
          "specialty": 'Autotransports',
          "functions": ''},
        { "number": '34.',
          "classification_name": 'VB1',
          "classification": 'Klientu apkalpošanas speciālists',
          "specialty": 'Administratīvie un sekretāra pakalpojumi',
          "functions": ''},
        { "number": '35.',
          "classification_name": 'VDD1',
          "classification": 'Digitālās drukas operators',
          "specialty": 'Poligrāfija un izdevējdarbība',
          "functions": ''},
        { "number": '36.',
          "classification_name": 'VET1',
          "classification": 'Elektrotehniķis',
          "specialty": 'Enerģētika un elektrotehnika',
          "functions": ''},
        { "number": '37.',
          "classification_name": 'VL1',
          "classification": 'Lietvedis',
          "specialty": 'Administratīvie un sekretāra pakalpojumi',
          "functions": ''},
        { "number": '38.',
          "classification_name": 'VPIT1',
          "classification": 'Poligrāfijas iekārtu tehniķis',
          "specialty": 'Poligrāfija un izdevējdarbība',
          "functions": ''},
        { "number": '39.',
          "classification_name": 'VPRT1',
          "classification": 'Poligrāfijas ražošanas tehniķis',
          "specialty": 'Poligrāfijas ražošanas tehnoloģijas un izstrādājumu izgatavošana',
          "functions": ''},
      ],

      selected: null,
      options: [
        { value:null, text: '-' },
        { text: 'Pēc 9. klase' },
        { text: 'Pēc 12. klase' }

      ]

    }
  }
}
</script>

<style scoped>

</style>