<template>
  <div>
    <b-container fluid>
      <b-row class="justify-content-md-center"
      >
        <b-col cols="8">
            <b-card
            title="Iesniegums"
            class="mb-2 mt-2"
            >

              <b-alert variant="danger" show v-for="e in errors">{{ e }}</b-alert>


              <b-card-text>
                <h6>* - ar zvaigznīti ir atzīmēti obligātie lauki</h6>
                <h3>Jūsu dati:</h3>
              </b-card-text>

              <b-form @submit="onSubmit">
                <b-form-group id="input-group-1" label="Vārds:*" label-for="input-1">
                  <b-form-input
                      id="input-1"
                      v-model="form.name"
                      placeholder="Jūsu vārds"
                      required
                  ></b-form-input></b-form-group>

              <b-form-group id="input-group-2" label="Uzvārds:*" label-for="input-2">
                <b-form-input
                    id="input-2"
                    v-model="form.surname"
                    placeholder="Jūsu uzvārds"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-3" label="Personas kods:*" label-for="input-3">
                <b-form-input
                    id="input-3"
                    v-model="form.personal_code"
                    placeholder="0000000-00000"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-4" label="Deklarētā adrese (iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods):*" label-for="input-4">
                <b-form-input
                    id="input-4"
                    v-model="form.home"
                    placeholder="Jūsu deklarētā (iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods)"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-5" label="Telefona nr.:*" label-for="input-3">
                <b-form-input
                    id="input-5"
                    v-model="form.telephone"
                    placeholder=""
                    required
                ></b-form-input>
              </b-form-group>

              <b-form @submit="onSubmit" @reset="onReset">
                <b-form-group
                    id="input-group-6"
                    label="Epasts:*"
                    label-for="input-6"
                >
                  <b-form-input
                      id="input-6"
                      v-model="form.email"
                      type="email"
                      placeholder="Jūsu epasts"
                      required
                  ></b-form-input>
                </b-form-group>
              </b-form>

              <b-form-group id="input-group-7" label="Izglītība:*" label-for="input-7">
                <b-form-input
                    id="input-7"
                    v-model="form.education"
                    placeholder="Jūsu izglītība, piemēram, pamata"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-8" label="Iegūtās izglītības programmas kods (sekmju izrakstā, 8 ciparu skaitlis):*" label-for="input-8">
                <b-form-input
                    id="input-8"
                    v-model="form.education_code"
                    placeholder=""
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-9" label="Mācību iestādes nosaukums (kuru pabeidzāt):*" label-for="input-9">
                <b-form-input
                    id="input-9"
                    v-model="form.education_name"
                    placeholder="Skolas nosaukums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-10" label="Pabeigšanas gads:*" label-for="input-10">
                <b-form-input
                    id="input-10"
                    v-model="form.year"
                    placeholder="Piemēram, 2016"
                    required
                ></b-form-input>
              </b-form-group>

              <h3>Jūsu sekmes:</h3>

                <b-form-group id="input-group-31" label="Svešvaloda:">
                  <b-form-radio-group
                      id="radio-group-5"
                      required
                  >
                    <b-form-radio v-model="form.marks.language" name="radio-size" value="english">angļu</b-form-radio>
                    <b-form-radio v-model="form.marks.language" name="radio-size" value="french">franču</b-form-radio>
                    <b-form-radio v-model="form.marks.language" name="radio-size" value="german">vācu</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>

              <b-form-group id="input-group-11" label="Svešvalodas noslēguma vērtējums (10 ballu skalā):*" label-for="input-11">
                <b-form-input
                    id="input-11"
                    v-model="form.marks.language_mark"
                    placeholder="1. svešvalodas vērtējums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-12" label="Matemātikas noslēguma vērtējums (10 ballu skalā):*" label-for="input-12">
                <b-form-input
                    id="input-12"
                    v-model="form.marks.math"
                    placeholder="Matemātikas vērtējums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-13" label="Latviešu valodas noslēguma vērtējums (10 ballu skalā):*" label-for="input-13">
                <b-form-input
                    id="input-13"
                    v-model="form.marks.latvian"
                    placeholder="Latviešu valodas vērtējums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-14" label="Fizikas noslēguma vērtējums (10 ballu skalā):*" label-for="input-14">
                <b-form-input
                    id="input-14"
                    v-model="form.marks.physics"
                    placeholder="Fizikas vērtējums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-15" label="Ķīmijas noslēguma vērtējums (10 ballu skalā):*" label-for="input-15">
                <b-form-input
                    id="input-15"
                    v-model="form.marks.chemistry"
                    placeholder="Ķīmijas vērtējums"
                    required
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-16" label="Informātikas noslēguma vērtējums (10 ballu skalā):
              Šo vērtējumu ir nepieciešams ievadīt tikai pamatskolas absolventiem:*" label-for="input-16">
                <b-form-input
                    id="input-16"
                    v-model="form.marks.informatics"
                    placeholder="Nav"
                ></b-form-input>
              </b-form-group>

              <h3>Radinieka dati:</h3>

              <b-form-group id="input-group-17" label="Mātes vārds un uzvārds, tālrunis, epasts:" label-for="input-17">
                <b-form-input
                    id="input-17"
                    v-model="form.relatives.mom.name"
                    placeholder="Mātes vārds"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-18" label-for="input-18">
                <b-form-input
                    id="input-18"
                    v-model="form.relatives.mom.surname"
                    placeholder="Mātes uzvārds"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-19"  label-for="input-19">
                <b-form-input
                    id="input-19"
                    v-model="form.relatives.mom.telephone"
                    placeholder="Mātes tālrunis"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-20"  label-for="input-20">
                <b-form-input
                    id="input-20"
                    v-model="form.relatives.mom.email"
                    placeholder="Mātes epasts"
                ></b-form-input>
              </b-form-group>

              <b-form-group label="Tēva vārds un uzvārds, tālrunis, epasts" id="input-group-21"  label-for="input-21">
                <b-form-input
                    id="input-21"
                    v-model="form.relatives.father.name"
                    placeholder="Tēva name"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-22"  label-for="input-22">
                <b-form-input
                    id="input-22"
                    v-model="form.relatives.father.surname"
                    placeholder="Tēva uzvārds"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-23"  label-for="input-23">
                <b-form-input
                    id="input-23"
                    v-model="form.relatives.father.telephone"
                    placeholder="Tēva tālrunis"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-24"  label-for="input-24">
                <b-form-input
                    id="input-24"
                    v-model="form.relatives.father.email"
                    placeholder="Tēva epasts"
                ></b-form-input>
              </b-form-group>

              <b-form-group label="Aizbildņa vārds un uzvārds, tālrunis, epasts" id="input-group-25"  label-for="input-25">
                <b-form-input
                    id="input-25"
                    v-model="form.relatives.guardian.name"
                    placeholder="Aizbildņa vārds"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-26"  label-for="input-26">
                <b-form-input
                    id="input-26"
                    v-model="form.relatives.guardian.surname"
                    placeholder="Aizbildņa uzvārds"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-27"  label-for="input-27">
                <b-form-input
                    id="input-27"
                    v-model="form.relatives.guardian.telephone"
                    placeholder="Aizbildņa tālrunis"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-28"  label-for="input-28">
                <b-form-input
                    id="input-28"
                    v-model="form.relatives.guardian.email"
                    placeholder="Aizbildņa epasts"
                ></b-form-input>
              </b-form-group>

              <h3>Specialitāte</h3>

              <div>
                <b-form-group label="Pirmā prioritātes specialitāte" >
                  <b-form-select v-model="form.speciality_id" :options="options" required></b-form-select>
                </b-form-group>
                <b-form-group label="Otrā prioritātes specialitāte">
                  <b-form-select v-model="form.secondary_speciality_id" :options="options" required></b-form-select>
                </b-form-group>
              </div>

                <b-row>
                  <b-col cols="6">
                   <span>Saskaņā ar uzņemšanas noteikumiem iesniegšu šādus dokumentus:</span>
                    
                  </b-col>
                  <b-col cols="6">
                    <ul>
                      <li>izglītības dokuments (kopija);</li>
                      <li>izziņa par veselības stāvokli (veidlapa Nr. 027/u);</li>
                      <li>4 fotogrāfijas (3x4 cm)</li>
                      <li>citi:_______</li>
                    </ul>
                  </b-col>
                </b-row>

                <h3>Papildinformācija:</h3>
                <b-form-group id="input-group-31" label="Vai ir nepieciešama dienesta viesnīca:">
                  <b-form-radio-group
                      id="radio-group-1"
                      required
                  >
                    <b-form-radio v-model="form.info.hostel" name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="form.info.hostel" name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-32" label="Esmu bārenis:">
                  <b-form-radio-group
                      id="radio-group-2"
                      required
                  >
                      <b-form-radio v-model="form.info.children" name="radio-size" value="yes">Jā</b-form-radio>
                      <b-form-radio v-model="form.info.children" name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-33" label="Esmu persona ar speciālām vajadzībām:">
                  <b-form-radio-group
                      id="radio-group-3"
                      required
                  >
                    <b-form-radio v-model="form.info.special" name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="form.info.special" name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-34" label="Esmu no daudzbērnu ģimenes:">
                  <b-form-radio-group
                      id="radio-group-4"
                      required
                  >
                    <b-form-radio v-model="form.info.family" name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="form.info.family" name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>

              <h3>Pielikumi</h3>
                <b-form-group id="input-group-29" label='Pielikums "Apliecības vai atestācijas foto (jpg, jpeg, png, pdf un gif failu formātā)"*'  label-for="input-29">
                  <b-form-file
                      id="input-29"
                      v-model="form.document1"
                      placeholder="Izvēlaties failu šeit..."
                      drop-placeholder="Ieliekat failu šeit..."
                      required
                  ></b-form-file>
                </b-form-group>

                <b-form-group id="input-group-30" label='Pielikums "Apliecības vai atestācijas foto (jpg, jpeg, png, pdf un gif failu formātā)"*'  label-for="input-30">
                  <b-form-file
                      id="input-30"
                      v-model="form.document2"
                      placeholder="Izvēlaties failu šeit..."
                      drop-placeholder="Ieliekat failu šeit..."
                      required
                  ></b-form-file>
                </b-form-group>

              <b-button class="mt-5" type="submit" variant="primary">Sūtīt</b-button>
              </b-form>
            </b-card>
        </b-col>

      </b-row>
    </b-container>
  </div>

</template>

<script>
import jsonToFormData from "@ajoelp/json-to-formdata";

export default {
  data() {
    return {
      errors: [],
      form: {
        name: '',
        surname: '',
        personal_code: '',
        home: '',
        telephone: '',
        email: '',
        education: '',
        education_code: '',
        education_name: '',
        year: '',
        marks: {
          language: '',
          language_mark: '',
          math: '',
          latvian: '',
          physics: '',
          chemistry: '',
          informatics: '',
        },
        relatives: {
          mom: {
            name: '',
            surname: '',
            telephone: '',
            email: '',
          },
          father: {
            name: '',
            surname: '',
            telephone: '',
            email: '',
          },
          guardian: {
            name: '',
            surname: '',
            telephone: '',
            email: '',
          },
        },
        speciality_id: null,
        secondary_speciality_id: null,
        info: {
          hostel: '',
          children: '',
          special: '',
          family: '',
        },
        document1: null,
        document2: null,
      },

      fields: [
        {key: 'english', label: 'Angļu'},
        {key: 'french', label: 'Franču'},
        {key: 'german', label: 'Vācu.'},
      ],

      selected: [],
      options: [],
    }
  },
  mounted() {
    this.getOptions();
  },
  methods: {
    getOptions() {
      axios.get('/specialities').then(response => {
        response.data.data.forEach(e => {
          e.text = (e.class === '1' ? '[Pēc 9. klases] ' : '[Pēc 12. klases] ') + e.speciality + ' - ' + e.name;
          e.value = e.id;
        })

        this.options = response.data.data;
      })
    },
    validateRelatives() {
      if(Object.values(this.form.relatives.mom).every(v => v)) {
        return true;
      } else if(Object.values(this.form.relatives.father).every(v => v)) {
        return true;
      } else if(Object.values(this.form.relatives.guardian).every(v => v)) {
        return true;
      }

      return false;
    },
    onSubmit(event) {
      event.preventDefault()

      this.errors = [];

      if(!this.validateRelatives()) {
        this.errors.push('Jābūt aizpildītam vismaz viena aizbildņa informācijai!')
      }

      axios.post('/applications', jsonToFormData(this.form)).then(response => {
        console.log(response);
      });
    },
    onReset(event) {
      event.preventDefault()
    }
  }
}

</script>

<style scoped>

</style>