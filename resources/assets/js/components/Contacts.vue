<template>
    <div class="card">
        <div class="card-body">
            <p><a href="#" class="card-link" data-toggle="modal" data-target="#addContactModal">New Contact</a></p>

            <form class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search" v-model="searchQuery" placeholder="Search">
                </div>
            </form>
        </div>
        <ul class="list-group list-group-flush">
            <li v-for="contact,key in searchResults" class="list-group-item">
                {{ contact.name }}
                <div class="float-right">
                    <a href="#" class="card-link" data-toggle="modal" data-target="#deleteContactModal" v-on:click.prevent="getContact(key)"><i class="fa fa-fw fa-trash"></i></a>
                    <a href="#" class="card-link" data-toggle="modal" data-target="#editContactModal" v-on:click.prevent="getContact(key)"><i class="fa fa-fw fa-edit"></i></a>
                    <a href="#" class="card-link" data-toggle="modal" data-target="#showContactModal" v-on:click.prevent="getContact(key)"><i class="fa fa-fw fa-eye"></i></a>
                </div>
            </li>
        </ul>

        <add-contact-modal v-bind:apiToken="this.apiToken"></add-contact-modal>
        <show-contact-modal></show-contact-modal>
        <edit-contact-modal v-bind:apiToken="this.apiToken"></edit-contact-modal>
        <delete-contact-modal v-bind:apiToken="this.apiToken"></delete-contact-modal>
    </div>
</template>

<script>
    const addContactModal = require('./modals/AddContact.vue');
    const showContactModal = require('./modals/ShowContact.vue');
    const editContactModal = require('./modals/EditContact.vue');
    const deleteContactModal = require('./modals/DeleteContact.vue');

    export default {
        props: ['apiToken'],

        components: {
            'add-contact-modal': addContactModal,
            'show-contact-modal': showContactModal,
            'edit-contact-modal': editContactModal,
            'delete-contact-modal': deleteContactModal
        },

        data: function () {
            return {
                contacts: {},
                errors: {},
                searchQuery: '',
                searchResults: {}
            };
        },

        methods: {
            getContacts() {
                let vm = this;
                let endPoint = '/api/contacts?api_token=' + vm.apiToken;

                axios.get(endPoint)
                        .then(function (response) {
                            vm.contacts = vm.searchResults = response.data;
                        })
                        .catch(function (error) {
                            vm.errors = error.response.data.errors;
                        });
            },

            getContact(key) {
                let contact = this.searchResults[key];

                this.$children[1].contact = contact;
                this.$children[2].contact = contact;
                this.$children[3].contact = contact;
            }
        },

        created() {
            this.getContacts();
        },

        watch: {
            searchQuery() {
                if (this.searchQuery.length > 0) {
                    let vm = this;

                    this.searchResults = this.contacts.filter(function (item) {
                        return Object.keys(item).some(function (key) {
                            let query = String(item[key]);

                            return query.toLowerCase().indexOf(vm.searchQuery.toLowerCase()) > -1;
                        });

                    });
                } else {
                    this.searchResults = this.contacts;
                }
            }
        }
    }
</script>