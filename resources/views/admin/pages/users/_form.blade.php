<div class="has-warning form-group">
    <label for="inputIsInvalid" class=" form-control-label">Name</label>
    <input type="text" id="inputIsInvalid" name="name" class="{{$errors->has('name') ? 'is-invalid' : ''}}  form-control" value="{{old('name', $dataForm['name'] ?? null)}}">
    @if ($errors->has('name'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </span>
    @endif
</div>

@if(empty($dataForm))
    <div class="has-warning form-group">
        <label for="inputIsInvalid" class=" form-control-label">Email</label>
        <input type="text" id="inputIsInvalid" name="email" class="{{$errors->has('email') ? 'is-invalid' : ''}}  form-control" value="{{old('email')}}">
        @if ($errors->has('email'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </span>
        @endif
    </div>
@endif

@if(empty($dataForm))
    <div class="has-warning form-group">
        <label for="inputIsInvalid" class=" form-control-label">Password</label>
        <input type="text" id="inputIsInvalid" name="password" class="{{$errors->has('password') ? 'is-invalid' : ''}}  form-control" value="{{old('password')}}">
        @if ($errors->has('password'))
            <span class="help-block">
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </span>
        @endif
    </div>
@endif

<div class="has-warning form-group">
    <label for="inputIsInvalid" class=" form-control-label">Choose Role</label>
    <select name="role_ids[]" id="multiple-select" multiple="" class="form-control {{$errors->has('role_ids') ? 'is-invalid' : ''}}">
        @foreach ($data_role as $item)
        <option 
        @if (!empty($dataForm['roles']))
            @foreach ($dataForm['roles'] as $item_role)
                {{ $item_role['id'] == $item['id'] ? "selected":"" }}
            @endforeach
        @elseif(old("role_ids"))
            {{ (in_array($item['id'], old("role_ids")) ? "selected":"") }}
        @endif 
        
        value="{{$item['id']}}">{{$item['name']}}</option>
        @endforeach
    </select>
    @if ($errors->has('role_ids'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('role_ids') }}</small>
        </span>
    @endif
</div>

<div class="has-warning form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>