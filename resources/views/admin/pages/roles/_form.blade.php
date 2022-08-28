<div class="has-warning form-group">
    <label for="inputIsInvalid" class=" form-control-label">Name</label>
    <input type="text" id="inputIsInvalid" name="name" class="{{$errors->has('name') ? 'is-invalid' : ''}}  form-control" value="{{old('name', $dataForm->name ?? null)}}">
    @if ($errors->has('name'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </span>
    @endif
</div>

<div class="row form-group">

    <div class="col col-md-3">
        <label for="multiple-select" class=" form-control-label">Multiple select</label>
    </div>
    <div class="col col-md-9">
        <select name="permission_ids[]" id="multiple-select" multiple="" class="form-control">
            @foreach ($data_permission as $item)
            <option 
            @if (!empty($dataForm['permissions']))
                @foreach ($dataForm['permissions'] as $item_permission)
                    {{ $item_permission['id'] == $item['id'] ? "selected":"" }}
                @endforeach
            @elseif(old("permission_ids"))
                {{ (in_array($item['id'], old("permission_ids")) ? "selected":"") }}
            @endif 
            
            value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="has-warning form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>