@extends('admin.master')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">User Feedbacks</h4>
        <p class="card-category">User Feedbacks Stats</p>
      </div>
      <div class="card-body table-responsive">
        @if(!isset($feedbacks[0]))
          <div class="text-warning">
            No Feedback Found!
          </div>
        @else
          <table class="table table-hover">
            <thead class="text-danger">
              <th>S.#</th>
              <th>Name</th>
              <th>Feedback</th>
            </thead>
            <tbody>
              @php $counter = 1; @endphp
              @foreach($feedbacks as $feedback)
                <tr>
                  <td>{{ $counter }}</td>
                  <td>{{ $feedback->customer_name }}</td>
                  <td>
                      <p class="text-wrap">{{ $feedback->feedback }}</p>
                  </td>
                </tr>
              @php $counter++; @endphp
              @endforeach
            </tbody>
          </table>
              {{ $feedbacks->links() }}
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
