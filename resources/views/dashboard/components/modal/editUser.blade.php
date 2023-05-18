<div class="modal fade" id="edit-User-Modal" style="display: none; padding-right: 17px;" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Edit Roles User : <span id="name"></span> - <span id="roles_now"></span></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf
                          <div class="card-body">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category name</label>
                                <select class="form-control" id="roles_value" name="roles"> 
                                    <option value="USER">USER</option>
                                    <option value="ADMIN">ADMIN</option>
                                </select>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                          </div>
                          <!-- /.card-body -->
                        </form>
                      </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
