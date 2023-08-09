<div class="modal fade" id="sendMessageModal" tabindex="200" role="dialog" aria-labelledby="sendMessageModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $Url = url('user/message');
            ?>
            <input type="hidden" name="messageSelectedUsersFormUrl"
                   id="messageSelectedUsersFormUrl" value="{{$Url}}"/>
            <div class="modal-header">
                <h5 class="modal-title" id="sendMessageModalLabel">Send Message</h5>
            </div>
            <div class="modal-body">
                <div>
                    <input type="text" class="form-control"
                           name="send_message_title" id="send_message_title"
                           placeholder="Title" />
                </div>
                <div>
                    <textarea class="form-control" name="send_message_box"
                              id="send_message_box" placeholder="Message"
                              rows="5" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Send</button>
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>