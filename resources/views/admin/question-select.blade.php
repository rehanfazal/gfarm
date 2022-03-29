@if(isset($questions[0]) && $questions)
    @foreach($questions as $sC)
        <option value="{{ $sC->id }}">{{ $sC->info_text }}</option>
    @endforeach
@else
    <option value="">No Question Available</option>
@endif