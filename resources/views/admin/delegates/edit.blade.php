@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.delegate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.delegates.update", [$delegate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $delegate->user->id}}" id="">
            <input type="hidden" name="delegate_id" value="{{ $delegate->id}}" id="">
            
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $delegate->user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $delegate->user->last_name) }}" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $delegate->user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $delegate->user->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label class="required" for="district_id">{{ trans('cruds.user.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $delegate->user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                        @foreach($cities as $id => $entry)
                            <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $delegate->user->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="zip_code">{{ trans('cruds.user.fields.zip_code') }}</label>
                    <input class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" id="zip_code" value="{{ old('zip_code', $delegate->user->zip_code) }}" required>
                    @if($errors->has('zip_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('zip_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.zip_code_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="address">{{ trans('cruds.user.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $delegate->user->address) }}" required>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.address_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label class="required" for="discount_code">{{ trans('cruds.delegate.fields.discount_code') }}</label>
                    <input class="form-control {{ $errors->has('discount_code') ? 'is-invalid' : '' }}"  pattern="^\S+$" {{-- for none space --}}
                    type="text" name="discount_code" id="discount_code" value="{{ old('discount_code', $delegate->discount_code) }}" required>
                    @if($errors->has('discount_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('discount_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.delegate.fields.discount_code_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="discount">{{ trans('cruds.delegate.fields.discount') }}</label>
                    <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', $delegate->discount) }}" required>
                    @if($errors->has('discount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('discount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.delegate.fields.discount_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="facebook">{{ trans('cruds.delegate.fields.facebook') }}</label>
                    <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', $delegate->facebook) }}" required>
                    @if($errors->has('facebook'))
                        <div class="invalid-feedback">
                            {{ $errors->first('facebook') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.delegate.fields.facebook_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="instagram">{{ trans('cruds.delegate.fields.instagram') }}</label>
                    <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $delegate->instagram) }}" required>
                    @if($errors->has('instagram'))
                        <div class="invalid-feedback">
                            {{ $errors->first('instagram') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.delegate.fields.instagram_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="youtube">{{ trans('cruds.delegate.fields.youtube') }}</label>
                    <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', $delegate->youtube) }}" required>
                    @if($errors->has('youtube'))
                        <div class="invalid-feedback">
                            {{ $errors->first('youtube') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.delegate.fields.youtube_helper') }}</span>
                </div>  
                <div class="form-group col-md-3">
                    <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    </div>
                    @if($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($delegate->user) && $delegate->user->photo)
                    var file = {!! json_encode($delegate->user->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection