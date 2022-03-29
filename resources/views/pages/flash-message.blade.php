@if ($message = Session::get('success'))
    <!-- <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> -->
    <script>
        showNotificationModal('top','right','{{ $message }}','success','check_circle');
    </script>
@endif

@if ($message = Session::get('error'))
    <!-- <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> -->
    <script>
        showNotificationModal('top','right','{{ $message }}','danger','error');
    </script>
@endif


@if ($message = Session::get('warning'))
    <!-- <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> -->
    <script>
        showNotificationModal('top','right','{{ $message }}','warning','error');
    </script>
@endif


@if ($message = Session::get('info'))
    <!-- <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div> -->
    <script>
        showNotificationModal('top','right','{{ $message }}','info','error');
    </script>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @php $errorList = ""; @endphp
        @foreach ($errors->all() as $error)
            <li style="padding: 5px;">{{ $error }}</li>
            @php $errorList .= "<br>".$error;@endphp
        @endforeach
    </div>
@endif
