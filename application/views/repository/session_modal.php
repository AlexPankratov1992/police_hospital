<!-- Modal -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="width:300px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Session Management</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <button onclick="session(1)" class="btn btn-success">Start Session</button>
                    <button onclick="session(2)" class="btn btn-danger">End Session</button>
                </div>
                <div class="alert alert-info" id="msgbox" style="display:none;font-size:12px;margin-top: 5px;" role="alert">
                    <span id="msg"></span>
                </div>
            </div>
        </div>
    </div>
</div>