<script setup>

</script>

<template>
<div class="mt-4">


  <form class="mx-auto">
    <div class="mb-5">
      <label for="latitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Latitude</label>
      <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
    </div>
    <div class="mb-5">
      <label for="longitude" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Longitude</label>
      <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="mb-5">

    <form class="max-w-sm mx-auto">
      <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
      <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>Choose a coordinate</option>
        <option value="DD">Decimal Degrees (DD) </option>
        <option value="DMS">Degrees, Minutes, Seconds (DMS)</option>
      </select>
    </form>

    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Convert</button>
  </form>

</div>
</template>
