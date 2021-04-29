<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('tfg.routines.new') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('shared._errors')
            <form method="POST" action="{{ url('/routines/create') }}">
                <div class="modal-body">
                    @include('shared._routineFields')
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('tfg.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('tfg.routines.create') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
