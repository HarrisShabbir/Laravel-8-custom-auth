    <!--Add Fact Modal -->
    <div class="modal fade text-start" id="CreateFact" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Fact</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('fact.store') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Title: </label>
                        <div class="mb-1">
                            <input type="text" placeholder="Enter Title" class="form-control" name="title" />
                        </div>

                        <label>Content: </label>
                        <div class="mb-1">
                            <input name="content" type="text" placeholder="Enter Content" class="form-control" />
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

    <div class="modal fade text-start" id="UpdateFact" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Update Fact</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('fact.update') }}" method="POST" class="form">
                    @csrf
                    <div class="modal-body">
                        <label>Title: </label>
                        <div class="mb-1">
                            <input type="hidden" id="FactID" name="id"/>
                            <input type="text" placeholder="Enter Name" id="FactTitle" class="form-control" name="title" />
                        </div>
                        <label>Content: </label>
                        <div class="mb-1">
                            <input name="content" type="text" id="FactContent" placeholder="Guard Name" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
