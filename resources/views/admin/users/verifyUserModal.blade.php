<div class="modal fade" id="verifyUserModal" tabindex="200" role="dialog" aria-labelledby="verifyUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('users.verify')}}" id="userverifyForm">
                @csrf
                <input type="hidden" name="UserId" id="verifyUserId" value=""/>
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyUserModalLabel">Verify User</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Verify</button>
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>