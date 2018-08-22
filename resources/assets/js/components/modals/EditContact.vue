<template>
    <div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactModalLabel"><b>Edit {{ contact.name }}'s Details</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent>
                        <div class="form-group">
                            <label for="name" v-bind:class="{'text-danger':errors.name}">Name</label>
                            <input type="email" class="form-control" v-bind:class="{'is-invalid':errors.name}" id="name" name="name" v-model="contact.name" placeholder="e.g. Jane Doe" autofocus>
                            <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone" v-bind:class="{'text-danger':errors.phone}">Phone</label>
                            <input type="number" class="form-control" v-bind:class="{'is-invalid':errors.phone}" id="phone" name="phone" v-model="contact.phone" placeholder="e.g. 0720123456">
                            <span v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email" v-bind:class="{'text-danger':errors.email}">Email</label>
                            <input type="email" class="form-control" v-bind:class="{'is-invalid':errors.email}" id="email" name="email" v-model="contact.email" placeholder="e.g. jane.doe@domain.com">
                            <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="updateContact">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['apiToken'],

        data: function () {
            return {
                contact: {},
                errors: {}
            };
        },

        methods: {
            updateContact() {
                let vm = this;
                let endPoint = '/api/contacts/' + vm.contact.id + '?api_token=' + vm.apiToken;

                axios.patch(endPoint, this.$data.contact)
                        .then(function () {
                            vm.$parent.getContacts();
                            $('#editContactModal').modal('toggle');
                        })
                        .catch(function (error) {
                            vm.errors = error.response.data.errors;
                        });
            }
        }
    }
</script>
