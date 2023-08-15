<div class="modal fade" id="deletePermissionModal" tabindex="200" role="dialog" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('permission.delete')}}" id="deleteCermissionForm" method="post"
                  enctype="multipart/form-data">
                @csrf
                {{--Hidden Field for Id--}}
                <input type="hidden" name="id" id="deletePermissionId"/>
                <div class="modal-body mb-0">
                    <div class="row mb-0">
                        <div class="col-12 mb-3">
                            <h5 class="modal-title" id="deletePermissionModalLabel">Delete Cermission</h5>
                        </div>
                        <div class="col-12 mb-1">
                            <p class="text-left mb-3">
                                Are you sure?
                            </p>
                        </div>
                        <div class="col-12 text-right mb-0">
                            <button class="btn btn-danger mr-1" type="submit">
                                Yes
                            </button>
                            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



