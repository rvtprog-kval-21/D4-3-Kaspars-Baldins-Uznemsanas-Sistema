<template>
  <div>
    <b-container fluid>
      <b-row class="justify-content-center"
      >
        <b-col cols="8">
            <b-card
            title="Iesniegums"
            class="mb-2 mt-2"
            >

              <b-alert variant="danger" show v-for="e in errors">{{ e }}</b-alert>

              <b-alert variant="success" show v-if="success">Iesniegums tika veiksmīgi saglabāts!</b-alert>

              <b-card-text>
                <h6>* - ar zvaigznīti ir atzīmēti obligātie lauki</h6>
                <h3>Jūsu dati:</h3>
              </b-card-text>

              <b-form @submit.stop.prevent="onSubmit">
                <b-form-group id="input-group-1" label="Vārds:*" label-for="input-1">
                  <b-form-input
                      id="input-1"
                      v-model="$v.form.name.$model"
                      placeholder="Jūsu vārds"
                      :state="validateState('name')"
                      aria-describedby="input-1-live-feedback"
                  ></b-form-input>
                  <b-form-invalid-feedback
                      id="input-1-live-feedback"
                  >Nepareizi ievadīts jūsu vārds</b-form-invalid-feedback>
                </b-form-group>

              <b-form-group id="input-group-2" label="Uzvārds:*" label-for="input-2">
                <b-form-input
                    id="input-2"
                    v-model="$v.form.surname.$model"
                    placeholder="Jūsu uzvārds"
                    :state="validateState('surname')"
                    aria-describedby="input-2-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-2-live-feedback"
                >Nepareizi ievadīts jūsu uzvārds</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-3" label="Personas kods:*" label-for="input-3">
                <b-form-input
                    id="input-3"
                    placeholder="000000-00000"
                    v-model="$v.form.personal_code.$model"
                    :state="validateState('personal_code')"
                    aria-describedby="input-3-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-3-live-feedback"
                >Nepareizi ievadīts jūsu presona kods</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-4" label="Deklarētā adrese (iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods):*" label-for="input-4">
                <b-form-input
                    id="input-4"
                    v-model="$v.form.home.$model"
                    placeholder="Jūsu deklarētā (iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods)"
                    :state="validateState('home')"
                    aria-describedby="input-4-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-4-live-feedback"
                >Nepareizi ievadīts jūsu mājas adrese</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-5" label="Telefona nr.:*" label-for="input-5">
                <b-form-input
                    id="input-5"
                    v-model="$v.form.telephone.$model"
                    placeholder=""
                    :state="validateState('telephone')"
                    aria-describedby="input-5-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-5-live-feedback"
                >Nepareizi ievadīts jūsu telefona numurs</b-form-invalid-feedback>
              </b-form-group>

                <b-form-group
                    id="input-group-6"
                    label="Epasts:*"
                    label-for="input-6"
                >
                  <b-form-input
                      id="input-6"
                      v-model="$v.form.email.$model"
                      type="email"
                      placeholder="Jūsu epasts"
                      :state="validateState('email')"
                      aria-describedby="input-6-live-feedback"
                  >
                  </b-form-input>
                  <b-form-invalid-feedback
                      id="input-6-live-feedback"
                  >Nepareizi ievadīts jūsu e-pasts</b-form-invalid-feedback>
                </b-form-group>

              <b-form-group id="input-group-7" label="Izglītība:*" label-for="input-7">
                <b-form-input
                    id="input-7"
                    v-model="$v.form.education.$model"
                    placeholder="Jūsu izglītība, piemēram, pamata"
                    :state="validateState('education')"
                    aria-describedby="input-7-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-7-live-feedback"
                >Nepareizi ievadīta jūsu izglītība</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-8" label="Iegūtās izglītības programmas kods (sekmju izrakstā, 8 ciparu skaitlis):*"  label-for="input-8">
                  <a href="images/kods.webp" target="_blank">Kas ir izglītības programmas kods?</a>
                <b-form-input
                    id="input-8"
                    v-model="$v.form.education_code.$model"
                    placeholder=""
                    :state="validateState('education_code')"
                    aria-describedby="input-8-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-8-live-feedback"
                >Nepareizi ievadīts jūsu iegūtās izglītības programmas kods</b-form-invalid-feedback>
              </b-form-group>
                <b-form-group id="input-group-9" label="Mācību iestādes nosaukums (kuru pabeidzāt):*" label-for="input-9">
                <b-form-input
                    id="input-9"
                    v-model="$v.form.education_name.$model"
                    placeholder="Skolas nosaukums"
                    :state="validateState('education_name')"
                    aria-describedby="input-9-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-9-live-feedback"
                >Nepareizi ievadīts jūsu mācību iestādes nosaukums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-10" label="Mācību iestādes pabeigšanas gads:*" label-for="input-10">
                <b-form-input
                    id="input-10"
                    v-model="$v.form.year.$model"
                    placeholder="Piemēram, 2016"
                    :state="validateState('year')"
                    aria-describedby="input-10-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-10-live-feedback"
                >Nepareizi ievadīts jūsu pabeigšanas gads</b-form-invalid-feedback>
              </b-form-group>

              <h3>Jūsu sekmes:</h3>

                <b-form-group id="input-group-11" label="Svešvaloda:" v-slot="{ ariaDescribedby }">
                  <b-form-radio-group
                      id="radio-group-5"
                      v-model="$v.form.marks.language.$model"
                      :state="validateMarks('language')"
                      aria-describedby="input-11-live-feedback"
                  >
                    <b-form-radio v-model="$v.form.marks.language.$model" :state="validateMarks('language')"
                                  aria-describedby="input-11-live-feedback" name="radio-size" value="english">angļu</b-form-radio>
                    <b-form-radio v-model="$v.form.marks.language.$model" :state="validateMarks('language')"
                                  aria-describedby="input-11-live-feedback" name="radio-size" value="french">franču</b-form-radio>
                    <b-form-radio v-model="$v.form.marks.language.$model" :state="validateMarks('language')"
                                  aria-describedby="input-11-live-feedback" name="radio-size" value="german">vācu</b-form-radio>

                    <b-form-invalid-feedback
                        id="radio-11-live-feedback"
                    >Neatzīmēta svešvaloda</b-form-invalid-feedback>
                  </b-form-radio-group>
                </b-form-group>

              <b-form-group id="input-group-12" label="Svešvalodas noslēguma vērtējums (10 ballu skalā):*" label-for="input-12">
                <b-form-input
                    id="input-12"
                    v-model="$v.form.marks.language_mark.$model"
                    placeholder="1. svešvalodas vērtējums"
                    :state="validateMarks('language_mark')"
                    aria-describedby="input-12-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-12-live-feedback"
                >Nepareizi ievadīts jūsu svešvalodas noslēguma vērtējums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-13" label="Matemātikas noslēguma vērtējums (10 ballu skalā):*" label-for="input-13">
                <b-form-input
                    id="input-13"
                    v-model="$v.form.marks.math.$model"
                    placeholder="Matemātikas vērtējums"
                    :state="validateMarks('math')"
                    aria-describedby="input-13-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-13-live-feedback"
                >Nepareizi ievadīts jūsu matemātikas noslēguma vērtējums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-14" label="Latviešu valodas noslēguma vērtējums (10 ballu skalā):*" label-for="input-14">
                <b-form-input
                    id="input-14"
                    v-model="$v.form.marks.latvian.$model"
                    placeholder="Latviešu valodas vērtējums"
                    :state="validateMarks('latvian')"
                    aria-describedby="input-14-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-14-live-feedback"
                >Nepareizi ievadīts jūsu latviešu valodas noslēguma vērtējums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-15" label="Fizikas noslēguma vērtējums (10 ballu skalā):*" label-for="input-15">
                <b-form-input
                    id="input-15"
                    v-model="$v.form.marks.physics.$model"
                    placeholder="Fizikas vērtējums"
                    :state="validateMarks('physics')"
                    aria-describedby="input-15-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-15-live-feedback"
                >Nepareizi ievadīts jūsu fizikas noslēguma vērtējums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-16" label="Ķīmijas noslēguma vērtējums (10 ballu skalā):*" label-for="input-16">
                <b-form-input
                    id="input-16"
                    v-model="$v.form.marks.chemistry.$model"
                    placeholder="Ķīmijas vērtējums"
                    :state="validateMarks('chemistry')"
                    aria-describedby="input-16-live-feedback"
                ></b-form-input>
                <b-form-invalid-feedback
                    id="input-16-live-feedback"
                >Nepareizi ievadīts jūsu Ķīmijas noslēguma vērtējums</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group id="input-group-17" label="Informātikas vai datorikas noslēguma vērtējums (10 ballu skalā):
              Šo vērtējumu ir nepieciešams ievadīt tikai pamatskolas absolventiem:*" label-for="input-17">
                <b-form-input
                    id="input-17"
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
                <b-form-group label="Filiāle">
                  <b-form-select v-model="$v.form.branch_id.$model" :options="branches"
                                 :state="validateState('branch_id')" aria-describedby="input-17-live-feedback"></b-form-select>
                  <b-form-invalid-feedback
                      id="branch-17-live-feedback"
                  >Nav izvēlēta filiāle</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group label="Pirmā prioritātes specialitāte" :disabled="!form.branch_id"
                              :state="validateState('speciality_id')" aria-describedby="input-18-live-feedback">
                  <b-form-select v-model="$v.form.speciality_id.$model" :options="sortedOptions"
                                 :state="validateState('speciality_id')" aria-describedby="input-18-live-feedback"
                  ></b-form-select>
                  <b-form-invalid-feedback
                      id="branch-18-live-feedback"
                  >Nav izvēlēta pirmā prioritātes specialitāte</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group label="Otrā prioritātes specialitāte (Nav obligāta)" :disabled="!form.branch_id"
                              >
                  <b-form-select v-model="form.secondary_speciality_id" :options="sortedOptions" ></b-form-select>
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
                      v-model="$v.form.info.hostel.$model"
                      :state="validateInfo('hostel')"
                      aria-describedby="input-20-live-feedback"
                  >
                    <b-form-radio v-model="$v.form.info.hostel.$model" :state="validateInfo('hostel')" aria-describedby="input-20-live-feedback"
                                  name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="$v.form.info.hostel.$model" :state="validateInfo('hostel')" aria-describedby="input-20-live-feedback"
                                  name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-32" label="Esmu bārenis:">
                  <b-form-radio-group
                      id="radio-group-2"
                      v-model="$v.form.info.children.$model"
                      :state="validateInfo('children')"
                      aria-describedby="input-22-live-feedback"
                  >
                      <b-form-radio v-model="$v.form.info.children.$model"  :state="validateInfo('children')" aria-describedby="input-23-live-feedback"
                                    name="radio-size" value="yes">Jā</b-form-radio>
                      <b-form-radio v-model="$v.form.info.children.$model"  :state="validateInfo('children')" aria-describedby="input-23-live-feedback"
                                    name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-33" label="Esmu persona ar speciālām vajadzībām:">
                  <b-form-radio-group
                      id="radio-group-3"
                      v-model="$v.form.info.special.$model"
                      :state="validateInfo('special')"
                      aria-describedby="input-24-live-feedback"
                  >
                    <b-form-radio v-model="$v.form.info.special.$model"  :state="validateInfo('special')" aria-describedby="input-24-live-feedback"
                                  name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="$v.form.info.special.$model"  :state="validateInfo('special')" aria-describedby="input-24-live-feedback"
                                  name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>
                <b-form-group id="input-group-34" label="Esmu no daudzbērnu ģimenes:">
                  <b-form-radio-group
                      id="radio-group-4"
                      v-model="$v.form.info.family.$model"
                      :state="validateInfo('family')"
                      aria-describedby="input-25-live-feedback"
                  >
                    <b-form-radio v-model="$v.form.info.family.$model"  :state="validateInfo('family')" aria-describedby="input-25-live-feedback"
                                  name="radio-size" value="yes">Jā</b-form-radio>
                    <b-form-radio v-model="$v.form.info.family.$model"  :state="validateInfo('family')" aria-describedby="input-25-live-feedback"
                                  name="radio-size" value="no">Nē</b-form-radio>
                  </b-form-radio-group>
                </b-form-group>

              <h3>Pielikumi</h3>
                <b-form-group id="input-group-29" label='Pielikums "Apliecības vai atestācijas foto (jpg, jpeg, png, pdf un gif failu formātā)"*'  label-for="input-29">
                  <b-form-file
                      id="input-29"
                      v-model="$v.form.document1.$model"
                      placeholder="Izvēlaties failu šeit..."
                      drop-placeholder="Ieliekat failu šeit..."
                      :state="validateState('document1')"
                      aria-describedby="input-25-live-feedback"
                  ></b-form-file>
                  <b-form-invalid-feedback
                      id="file-15-live-feedback"
                  >Nav ievietots fails</b-form-invalid-feedback>
                </b-form-group>

                <b-form-group id="input-group-30" label='Pielikums "Apliecības vai atestācijas foto (jpg, jpeg, png, pdf un gif failu formātā)"*'  label-for="input-30">
                  <b-form-file
                      id="input-30"
                      v-model="$v.form.document2.$model"
                      placeholder="Izvēlaties failu šeit..."
                      drop-placeholder="Ieliekat failu šeit..."
                      :state="validateState('document2')"
                      aria-describedby="input-25-live-feedback"
                  ></b-form-file>
                  <b-form-invalid-feedback
                      id="file-16-live-feedback"
                  >Nav ievietots fails</b-form-invalid-feedback>
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
import { validationMixin } from 'vuelidate'
import { required, minLength,maxLength,numeric,email,alpha,between } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(3),
      },
      surname: {
        required,
      },
      personal_code: {
        required,
        minLength: minLength(12),
        maxLength: maxLength(12),
      },
      home: {
        required
      },
      telephone: {
        required,
        minLength: minLength(8),
        maxLength: maxLength(8),
        numeric: numeric
      },
      email: {
        required,
        email: email
      },
      education: {
        required
      },
      education_code: {
        required,
        minLength: minLength(8),
        maxLength: maxLength(8)
      },
      education_name: {
        required
      },
      year: {
        required,
        numeric: numeric,
        minLength: minLength(4),
        maxLength: maxLength(4)
      },

    marks: {
      language: {
        required
      },
      language_mark: {
        required,
        numeric: numeric,
        maxLength: maxLength(2)
      },
      math: {
        required,
        numeric: numeric,
        maxLength: maxLength(2)
      },
      latvian: {
        required,
        numeric: numeric,
        maxLength: maxLength(2)
      },
      physics: {
        required,
        numeric: numeric,
        maxLength: maxLength(2)
      },
      chemistry: {
        required,
        numeric: numeric,
        maxLength: maxLength(2)
      },
        // informatics: {
        //   numeric: numeric,
        // },
    },
      branch_id: {
        required
      },
      speciality_id: {
        required
      },
      // secondary_speciality_id: {
      //   required
      // },
    info:{
      hostel: {
        required,
      },
      children: {
        required
      },
      special: {
        required
      },
      family: {
        required
      },
    },
      document1: {
        required
      },
      document2: {
        required
      },
    },
    fields: [
      {key: 'english', label: 'Angļu'},
      {key: 'french', label: 'Franču'},
      {key: 'german', label: 'Vācu.'},
    ],
    selected: [],
    options: [],
    sortedOptions: [],
    branches: [],
    success: false,
  },

    data() {
      return {
        errors: [],
        form: {
          msg: [],
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
          branch_id: null,
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
        sortedOptions: [],
        branches: [],
        success: false,
      }
    },
    mounted() {
      this.getOptions();
    },
    watch: {
      'form.branch_id': function (newVal) {
        this.sortedOptions = this.options.filter(e => e.branch_id == newVal);
        // console.log(this.sortedOptions)
      }
    },
    methods: {
      getOptions() {
        axios.get('/specialities').then(response => {
          response.data.data.forEach(e => {
            e.text = (e.class === '1' ? '[Pēc 9. klases] ' : '[Pēc 12. klases] ') + e.speciality + ' - ' + e.name;
            e.value = e.id;

          })

          this.options = response.data.data;
          // console.log(this.options)
        })

        axios.get('/branches').then(response => {

          this.branches = response.data.data;
        })
      },

      validateState(name) {
        // console.log(name)

        const {$dirty, $error} = this.$v.form[name];

        return $dirty ? !$error : null;
      },

      validateMarks(name) {
        // console.log(this.$v.form.marks[name])

        const {$dirty, $error} = this.$v.form.marks[name];

        return $dirty ? !$error : null;
      },

      validateInfo(name) {

        const {$dirty, $error} = this.$v.form.info[name];

        return $dirty ? !$error : null;
      },

      // validateRelatives() {
      //   if(Object.values(this.form.relatives.mom).every(v => v)) {
      //     return true;
      //   } else if(Object.values(this.form.relatives.father).every(v => v)) {
      //     return true;
      //   } else if(Object.values(this.form.relatives.guardian).every(v => v)) {
      //     return true;
      //   }
      //
      //   return false;
      // },
      onSubmit(event) {
        event.preventDefault()

        this.errors = [];

        this.$v.form.$touch();
        if (this.$v.form.$anyError) {
          this.errors.push('Nav aizpildīti visi lauki')
          window.scrollTo(0, 0);
          return;
        }


        // if(!this.validateRelatives()) {
        //   this.errors.push('Jābūt aizpildītam vismaz viena aizbildņa informācijai!')
        // }

        axios.post('/applications', jsonToFormData(this.form)).then(response => {
          this.success = true;
          window.scrollTo(0, 0);
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