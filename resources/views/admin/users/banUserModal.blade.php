<div class="modal fade" id="banUserModal" tabindex="200" role="dialog" aria-labelledby="banUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('users.ban')}}" id="userBanForm">
                @csrf
                <input type="hidden" name="UserId" id="banUserId" value=""/>
                <div class="modal-header">
                    <h5 class="modal-title" id="banUserModalLabel">Ban User</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Ban</button>
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>