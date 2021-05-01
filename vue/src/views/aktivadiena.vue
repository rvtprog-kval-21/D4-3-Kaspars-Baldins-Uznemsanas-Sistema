<template>
  <div>
    <b-table responsive :items="items" :fields="fields" :tbody-tr-class="rowClass"></b-table>
  </div>
</template>

<script>
export default {
  data() {
    return {

      fields: [
        {key: 'number', label: 'Nr.'},
        {key: 'name', label: 'Vārds.'},
        {key: 'surname', label: 'Uzvārds'},
        {key: 'pk', label: 'P.K.'},
        {key: 'Cipher', label: 'Šifrs'},
        {key: 'language', label: '1. svešvaloda'},
        {key: 'language_mark', label: '1. svešvalodas vērtējums'},
        {key: 'mathematics', label: 'Matemātika'},
        {key: 'latvian_language', label: 'Latviešu valoda'},
        {key: 'physics', label: 'Fizika'},
        {key: 'chemistry', label: 'Ķīmija'},
        {key: 'informatics', label: 'Informātika'},
        {key: 'average_mark', label: 'Vid. vērtējums.'},
        {key: 'photo_of_attestation', label: 'Apliecības vai atestācijas foto'},
        {key: 'marks_photo', label: 'Sekmju izraksta foto'},
        {key: 'functions', label: 'Funkcijas'},
      ],

      items: [
        { "number": '--', "name": '--', "surname": '--',
          "pk": '--',"Cipher": '--', "language": '--', "language_mark": '--',
          "mathematics": '--', "latvian_language": '--', "physics": '--',
          "chemistry": '--', "informatics": '--',
          "average_mark": '--', "photo_of_attestation": '--',
          "marks_photo": '--', "functions": '--'},

      ]
    }
  }
}
</script>