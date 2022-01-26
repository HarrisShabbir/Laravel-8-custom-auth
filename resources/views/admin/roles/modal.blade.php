    <!--Add Role Modal -->
    <div class="modal fade text-start" id="createrole" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Role</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('role.store') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Name: </label>
                        <div class="mb-1">
                            <input type="text" placeholder="Enter Name" class="form-control" name="name" />
                        </div>

                        <label>Guard Name: </label>
                        <div class="mb-1">
                            <input name="guard_name" type="text" placeholder="Guard Name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update Role Modal -->

    <div class="modal fade text-start" id="UpdateRole" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Role</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('role.update') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Name: </label>
                        <div class="mb-1">
                            <input type="hidden" id="RoleID" name="id"/>
                            <input type="text" placeholder="Enter Name" id="RoleName" class="form-control" name="name" />
                        </div>
                        <label>Guard Name: </label>
                        <div class="mb-1">
                            <input name="guard_name" type="text" id="GuardName" placeholder="Guard Name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
