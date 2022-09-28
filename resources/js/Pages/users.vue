<script setup>
import AppLayout from "../Layouts/Applayout.vue";
import {Link} from "@inertiajs/inertia-vue3";
defineProps({
  users: Object,
});
</script>
<template>
    <AppLayout>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="user in users" :key="user.id">
      <th scope="row">{{user.id}}</th>
      <td>{{user.name}}</td>
      <td>{{user.email}}</td>
    </tr>

  </tbody>
</table>
    </AppLayout>
</template>