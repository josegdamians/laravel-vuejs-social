<template>
    <div>
        <h1>Page Not Found</h1>
        <p>Sorry, the page you're looking for is not found</p>
        <br>
        <router-link :to="{ name: 'home'}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to home page</router-link>
    </div>
</template>