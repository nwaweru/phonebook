<template>
    <div class="modal fade" id="showContactModal" tabindex="-1" role="dialog" aria-labelledby="showContactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="showContactModalLabel"><b>{{ contact.name }}'s Details</b></h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                contact: {}
            };
        }
    }
</script>