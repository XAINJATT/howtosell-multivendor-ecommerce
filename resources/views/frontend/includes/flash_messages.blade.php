@if ($message = Session::get('success'))
    <!-- <div class="alert alert-success">
  <p></p>
</div> -->
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{ $message }}",
        })
    </script>
@endif
@if ($message = Session::get('message'))
    <!-- <div class="alert alert-success">
  <p></p>
</div> -->
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{ $message }}",
        })
    </script>
@endif

@if ($message = Session::get('error'))
    <!-- <div class="alert alert-danger">
  <p>{{ $message }}</p>
</div> -->
    <script>
        Toast.fire({
            icon: 'error',
            title: "{{ $message }}",
        })
    </script>
@endif
@if ($message = Session::get('middleware-error'))
    <!-- <div class="alert alert-warning">
  <p>{{ $message }}</p>
</div> -->
    <script>
        Toast.fire({
            icon: 'warning',
            title: "{{ $message }}",
        })
    </script>
@endif

@if ($errors->any())
    {{-- {{dd($errors)}} --}}
    {{-- <div class="alert alert-danger">
        <ul> --}}
             @foreach ($errors->all() as $error)
                 {{-- <li>{{ $error }}</li> --}}
                <script>
                Toast.fire({
                icon: 'error',
                title: "{{ $error }}",
                })
                </script>
        
                @break
            @endforeach
        {{-- </ul>
    </div> --}}
@endif

@push('scripts')
<script type="text/javascript">
    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, 3500); // 5 secs

    });
</script>
@endpush
@push('script')
<script type="text/javascript">
    $("document").ready(function() {
        setTimeout(function() {
            $("div.alert").remove();
        }, 3500); // 3.5 secs

    });
</script>
@endpush
