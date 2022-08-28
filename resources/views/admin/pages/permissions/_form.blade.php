<div class="has-warning form-group">
    <label for="inputIsInvalid" class=" form-control-label">Name</label>
    <input type="text" id="inputIsInvalid" name="name" class="{{$errors->has('name') ? 'is-invalid' : ''}}  form-control" value="{{old('name', $dataForm->name ?? null)}}">
    @if ($errors->has('name'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </span>
    @endif
</div>
<div class="has-warning form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>