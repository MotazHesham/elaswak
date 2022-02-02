
@php
    $name = 'name_' . app()->getLocale();
@endphp
@forelse($cities as $city)
    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->$name }}</option>
@empty 
    <option value="">لايوجد</option>
@endforelse