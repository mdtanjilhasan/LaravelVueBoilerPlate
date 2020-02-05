<!-- Modal -->
<div class="modal fade delete-modal" id="delete-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title text-center">Are You Sure To Delete?</h5>
                <div class="text-center pt-3 pb-3">
                    <i class="ik ik-alert-octagon text-warning display-2"></i>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form method="post" class="d-inline-block" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger confirm-delete">Yes Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
