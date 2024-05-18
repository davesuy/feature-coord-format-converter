<script>
import { ref, onMounted  } from 'vue';

export default {
  setup() {
    const formData = ref({
      latitude: '',
      latitude_display: '',
      longitude: '',
      longitude_display: '',
      coordinate: '',
      coordinate_display: '',
      format_error: false
    });
    const submitted = ref(false);

    const handleSubmit = () => {
      submitted.value = true;


      var latitude = formData.value.latitude;
      var longitude = formData.value.longitude;


      formData.value.latitude_display =   dd_formula_func(latitude);
      formData.value.longitude_display =   dd_formula_func(longitude);

      if(formData.value.coordinate === "DD") {

        formData.value.coordinate_display = "Degrees, Minutes, Seconds (DMS)";

      } else {

        formData.value.coordinate_display = "Decimal Degrees (DD)";

      }


    //  console.log('Form data:', formData.value.coordinate);

    };

    function dd_formula_func(input) {

      const latitude = input;
      var remove_char_lat =  latitude.replace("°", "");

      var whole_decimal = Math.floor(remove_char_lat);

      if (whole_decimal > 0) {
        var axis = 'N';
      } else if (whole_decimal < 0) {
        var axis = 'S';
      } else {
        var axis = 'E';
      }

      var minutes_calc = ((remove_char_lat - whole_decimal) * 60);

      var minutes = Math.floor(minutes_calc);

      var seconds_calc = remove_char_lat - Math.floor(remove_char_lat);
      var second_calc_2 = ((seconds_calc * 60 - minutes) * 60);

      var seconds = second_calc_2.toFixed(2);

      const result_DD = whole_decimal+ "°" + minutes + "′" + seconds + "′′";

      if(isNaN(whole_decimal) || isNaN(minutes) || isNaN(seconds)) {

        formData.value.format_error = true;

      } else {

        formData.value.format_error = false;

      }

      //console.log(isNaN(whole_decimal));
      return result_DD + axis;

    };

    onMounted(() => {

       const latitude = "123.4567°";

      dd_formula_func(latitude);

      // const latitude = "123.4567°";
      // var remove_char_lat =  latitude.replace("°", "");
      //
      // var whole_decimal = Math.floor(remove_char_lat);
      //
      // var minutes_calc = ((remove_char_lat - whole_decimal) * 60);
      //
      // var minutes = Math.floor(minutes_calc);
      //
      // var seconds_calc = remove_char_lat - Math.floor(remove_char_lat);
      // var second_calc_2 = ((seconds_calc * 60 - minutes) * 60);
      //
      // var seconds = second_calc_2.toFixed(2);
      //
      // const result_DD = whole_decimal+ "°" + minutes + "′" + seconds + "′′";
      //
      // console.log(result_DD);

    });

    return {
      formData,
      submitted,
      handleSubmit,
      dd_formula_func
    };
  }
};
</script>


<template>
<div class="mt-4">

  <h2 class="text-center mb-6 text-white text-3xl">Feature Coordinate Format Converter</h2>

  <form class="mx-auto" @submit.prevent="handleSubmit">
    <div class="mb-5">
      <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitude</label>
      <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" v-model="formData.latitude" required />
    </div>
    <div class="mb-5">
      <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude</label>
      <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required v-model="formData.longitude" />
    </div>
    <div class="mb-5">


      <label for="coordinate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
      <select id="coordinate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="formData.coordinate">
        <option selected>Choose a coordinate</option>
        <option value="DD">Decimal Degrees (DD) </option>
        <option value="DMS">Degrees, Minutes, Seconds (DMS)</option>
      </select>


    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Convert</button>
  </form>

  <div v-if="submitted">

      <div class="my-5 text-white" v-if="formData.format_error === false">

        <p>Latitude: {{ formData.latitude_display }}</p>
        <p>Longitude: {{ formData.longitude_display }}</p>
        <p>Coordinate: {{ formData.coordinate_display }}</p>

      </div>

      <div class="my-5 text-white" v-if="formData.format_error === true">
        <p>Format Error! please make sure the format is correct in putting the value.</p>
      </div>
  </div>

</div>
</template>
