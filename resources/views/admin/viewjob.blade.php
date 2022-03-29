@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Jobs</h4>
                <p class="card-category">View Job</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{ $job->title }}</h4>
                    </div>
                    @php $spUserInfo = \App\Models\Helper::getUserInfo($job->sp_id); @endphp
                    <div class="col-md-3">
                        @if($spUserInfo)
                        
                        <img class="img" src="
                                        @if($spUserInfo->profile_image)
                                            {{ $spUserInfo->profile_image }}
                                        @else
                                            {{ URL::to('public/images/userImages/no-user.png') }}
                                        @endif" width="50px" height="50px">{{ ucwords($spUserInfo->first_name." ".$spUserInfo->last_name) }}
                        <a class="" title="View Profile" data-toggle="modal" data-target="#spView{{ $job->id }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a> &nbsp;
                        <div class="modal" id="spView{{ $job->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content card card-profile">
                                    <div class="card-avatar">
                                        <a href="javascript:;">
                                            <img class="img" src="
                                        @if($spUserInfo->profile_image)
                                            {{ URL::to('public/images/'.$spUserInfo->profile_image) }}
                                        @else
                                            {{ URL::to('public/images/userImages/no-user.png') }}
                                        @endif" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-category text-gray">{{ $spUserInfo->role }}</h6>
                                        <h4 class="card-title">
                                            {{ ucwords($spUserInfo->first_name." ".$spUserInfo->last_name) }}
                                        </h4>
                                        <hr>
                                        <div class="card-description row" style="color:black;">
                                            <div class="col-sm-12">
                                                Email: {{ $spUserInfo->email }}<br>
                                                Phone: {{ $spUserInfo->phone }}<br>
                                            </div>
                                            <div class="col-sm-12">
                                                Location: {{ $spUserInfo->location }}<br>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-round"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        Service: {{ $job->getService->name }}
                    </div>
                    <div class="col-md-3">
                        Total Price: {{ $job->total_price }}
                    </div>
                    <div class="col-md-3">
                        @php $cUserInfo = \App\Models\Helper::getUserInfo($job->user_id); @endphp
                        
                        <img class="img" src="
                                        @if($cUserInfo->profile_image)
                                            {{-- URL::to('public/images/'.$cUserInfo->profile_image) --}}
                                            {{ $cUserInfo->profile_image }}
                                        @else
                                            {{ URL::to('public/images/userImages/no-user.png') }}
                                        @endif" width="50px" height="50px">Customer: {{ ucwords($cUserInfo->first_name." ".$cUserInfo->last_name) }}

                        <a class="" title="View Profile" data-toggle="modal" data-target="#userView{{ $job->id }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a> &nbsp;
                        <div class="modal" id="userView{{ $job->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content card card-profile">
                                    <div class="card-avatar">
                                        <a href="javascript:;">
                                            <img class="img" src="
                                        @if($cUserInfo->profile_image)
                                            {{ $cUserInfo->profile_image }}
                                        @else
                                            {{ URL::to('public/images/userImages/no-user.png') }}
                                        @endif" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-category text-gray">{{ $cUserInfo->role }}</h6>
                                        <h4 class="card-title">
                                            {{ ucwords($cUserInfo->first_name." ".$cUserInfo->last_name) }}
                                        </h4>
                                        <hr>
                                        <div class="card-description row" style="color:black;">
                                            <div class="col-sm-12">
                                                Email: {{ $cUserInfo->email }}<br>
                                                Phone: {{ $cUserInfo->phone }}<br>
                                            </div>
                                            <div class="col-sm-12">
                                                Location: {{ $cUserInfo->location }}<br>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-round"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><br><br>
                        Location: {{ $job->location }}
                    </div>
                    <div class="col-md-12 table-responsive">

                        <table class="table table-hover">
                            <thead class="text-danger">
                                <th>Question</th>
                                <th>Question Options</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $jobQuestions = $job->getQuestion;
                                @endphp
                                @foreach($jobQuestions as $questions)
                                <tr>
                                <td>
                                    <li>{{ $questions->getQuestion->question }}</li><br>
                                    <!-- <label>Job Info Text:</label>
                                    <p class="">{{ $questions->getQuestion->info_text }}</p> -->
                                </td>
                                <td>
                                    @php
                                        $jQoptions = $questions->getJobQuestionOptions($job->id,$questions->q_id);
                                    @endphp
                                    @foreach($jQoptions as $qOption)
                                        @php 
                                            $jOptionDet = $qOption->getQuestionOption;
                                        @endphp
                                        <li>{{ $jOptionDet->option_text }} - {{ $jOptionDet->total_price }}</li><br>
                                    @endforeach
                                </td>
                                <td></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 row"><br><br>
                        @php 
                            $images = $job->getJobImages;
                        @endphp
                        @if($images->isNotEmpty())
                            @foreach($images as $img)
                                <div class="col-sm-3">
                                    <a href="{{ asset('images/jobImages/'.$img->image) }}" target="_blank">
                                        <img src="{{ asset('images/jobImages/'.$img->image) }}" class="" width="100%" height="100%" style="overflow:hidden">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection