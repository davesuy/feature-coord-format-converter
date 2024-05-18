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
      format_error: false,
      notification: ''
    });
    const submitted = ref(false);

    const handleSubmit = () => {
      submitted.value = true;

      var latitude = formData.value.latitude;
      var longitude = formData.value.longitude;


      if(formData.value.coordinate === "DD") {

        formData.value.coordinate_display = "Degrees, Minutes, Seconds (DMS)";


        formData.value.latitude_display =   dd_formula_func(latitude);
        formData.value.longitude_display =   dd_formula_func(longitude);

      } else if(formData.value.coordinate === "DMS") {

        formData.value.latitude_display =   dms_formula_func(latitude);
        formData.value.longitude_display =  dms_formula_func(longitude);

        if(  formData.value.latitude_display === "" ||  formData.value.longitude_display === "") {

          formData.value.format_error = true;

        }

        formData.value.coordinate_display = "Decimal Degrees (DD)";

      } else if(formData.value.coordinate === "") {

        formData.value.notification = "Please select a coordinate.";

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

    function dms_formula_func(input) {


       var get_first_val =  input.split("∘");

      let degrees = get_first_val[0];

      var startIndex =  input.indexOf("∘");
      let endIndex = input.indexOf("′", startIndex + 1);

      if (startIndex === -1 || endIndex === -1 || startIndex >= endIndex) {
        return ''; // Return an empty string if characters are not found or invalid positions
      }

      var minutes = input.substring(startIndex + 1, endIndex);

      var startIndex2 =  input.indexOf("′");
      let endIndex2 = input.indexOf("′′", startIndex2 + 1);

      if (startIndex2 === -1 || endIndex2 === -1 || startIndex2 >= endIndex2) {
        return ''; // Return an empty string if characters are not found or invalid positions
      }

      var seconds = input.substring(startIndex2 + 1, endIndex2);

      let minutes_divide = minutes / 60;
      let seconds_divide = seconds / 3600;


      return Number(degrees) + Number(minutes_divide) + Number(seconds_divide) + "∘";

    };

    onMounted(() => {

      var latitude = "28∘2′55.55′′28";

      dms_formula_func(latitude);

      //console.log(dms_formula_func(latitude));

    });

    return {
      formData,
      submitted,
      handleSubmit,
      dd_formula_func,
      dms_formula_func,
    };
  }
};
</script>


<template>

  <div class="mt-4">

    <h2 class="text-center mb-6 text-white text-3xl">Feature Coordinate Format Converter</h2>
    <h4 class="text-white mb-2">Follow this formatting guide example to make the conversion work:</h4>
    <p class="text-white mb-4"><label for=""><strong>DD:</strong></label> 123.4567°</p>
    <p class="text-white mb-4"><label for=""><strong>DMS:</strong></label> 28∘2′55.55′′</p>

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


        <label for="coordinate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a coordinate</label>

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
