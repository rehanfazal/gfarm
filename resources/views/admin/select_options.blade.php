@if(isset($category[0]))
    @foreach($category as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
@else
    <option value="">No Option Available</option>
@endif