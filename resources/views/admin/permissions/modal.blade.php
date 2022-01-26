
    <!--Add Permission Modal -->
    <div class="modal fade text-start" id="createpermission" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Permission</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('permission.store') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Name: </label>
                        <div class="mb-1">
                            <input type="text" placeholder="Enter Name" class="form-control" name="name"/>
                        </div>

                        <label>Guard Name: </label>
                        <div class="mb-1">
                            <input name="guard_name" type="text" placeholder="Guard Name" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update Permission Modal -->
    <div class="modal fade text-start" id="updatepermission" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Permission</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('permission.update') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Name: </label>
                        <div class="mb-1">
                            <input type="hidden" id="PermissionID" name="id"/>
                            <input type="text" id="PermissionName" placeholder="Enter Name" class="form-control" name="name"/>
                        </div>

                        <label>Guard Name: </label>
                        <div class="mb-1">
                            <input name="guard_name" id="GuardName" type="text" placeholder="Guard Name" class="form-control"/>
                        </div>
                    </div>
                    @can('permission_edit')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>                        
                    @endcan

                </form>
            </div>
        </div>
    </div>
