@if(Session::has('successMessage'))
  <div class="sufee-alert alert with-close alert-success alert-dismissible fade show alert-close">
      {!! Session::get('successMessage') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="close-btn">&times;</span>
      </button>
  </div>
@endif

@if(Session::has('orderSuccessMessage'))
  <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
      {!! Session::get('orderSuccessMessage') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="close-btn">&times;</span>
      </button>
  </div>
@endif
@if(Session::has('orderErrorMessage'))
  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
      <strong>{!! Session::get('orderErrorMessage') !!}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="close-btn">&times;</span>
      </button>
  </div>
@endif

@if(Session::has('errorMessage'))
  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert-close">
      <strong>{!! Session::get('errorMessage') !!}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="close-btn">&times;</span>
      </button>
  </div>
@endif

<!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show alert-close">
      <strong>{{ $error }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true" class="close-btn">&times;</span>
      </button>
    </div>
    @endforeach
@endif -->


