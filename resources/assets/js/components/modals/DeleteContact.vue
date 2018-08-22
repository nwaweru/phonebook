<template>
    <div class="modal fade" id="deleteContactModal" tabindex="-1" role="dialog" aria-labelledby="deleteContactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title text-danger" id="deleteContactModalLabel">Delete <b>{{ contact.name }}</b>?</h5>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-right"><b>Name:</b></td>
                                <td>{{ contact.name }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Phone:</b></td>
                                <td>{{ contact.phone }}</td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Email:</b></td>
                                <td>{{ contact.email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" v-on:click.prevent="deleteContact">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                contact: {}
            };
        },

        methods: {
            deleteContact() {
                let vm = this;
                let endPoint = '/api/contacts/' + vm.contact.id + '?api_token=' + vm.apiToken;

                axios.delete(endPoint)
                        .then(function () {
                            vm.$parent.getContacts();
                            $('#deleteContactModal').modal('toggle');
                        })
                        .catch(function (error) {
                            vm.errors = error.response;
                        });
            }
        }
    }
</script>