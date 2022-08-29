<div class="has-warning form-group">
    <label for="inputIsInvalid" class=" form-control-label">Title</label>
    <input type="text" id="inputIsInvalid" name="title" class="{{$errors->has('title') ? 'is-invalid' : ''}}  form-control" value="{{old('title', $dataForm['title'] ?? null)}}">
    @if ($errors->has('title'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('title') }}</small>
        </span>
    @endif
</div>

<div class="row">
    {{-- <div class="col-6">
        <div class="has-warning form-group">
            <label for="inputIsInvalid" class=" form-control-label">Choose User</label>
            <select name="user_id" id="select" class="form-control {{$errors->has('user_id') ? 'is-invalid' : ''}}">
                <option value=" ">Choose User add to post</option>
                @foreach ($data_user as $item_user)
                    <option 
                    @if(!empty($dataForm['user_id']))
                        {{$dataForm['user_id'] == $item_user['id'] ? 'selected' : '' }}
                    @elseif(old('user_id'))
                        {{old('user_id') == $item_user['id'] ? 'selected' : '' }}
                    @endif
                    value="{{$item_user['id']}}"> {{$item_user['name']}}</option>
                @endforeach
            </select>
            @if ($errors->has('user_id'))
                <span class="help-block">
                    <small class="text-danger">{{ $errors->first('user_id') }}</small>
                </span>
            @endif
        </div>
    </div> --}}
    <div class="col-12">
        <div class="has-warning form-group">
            <label for="inputIsInvalid" class=" form-control-label">Choose image</label>
            <input type="file" name="img" id="file-input" name="file-input" class="form-control-file {{$errors->has('img') ? 'is-invalid' : ''}}">
        
            @if ($errors->has('img'))
                <span class="help-block">
                    <small class="text-danger">{{ $errors->first('img') }}</small>
                </span>
            @endif
        </div>

    </div>
</div>

<div class="has-warning form-group">   
    <label for="inputIsInvalid" class=" form-control-label">Content</label>
    <textarea name="content" id="textarea-input" rows="9" placeholder="Content..." class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}">{{old('content', $dataForm['content'] ?? null)}}</textarea>

    @if ($errors->has('content'))
        <span class="help-block">
            <small class="text-danger">{{ $errors->first('content') }}</small>
        </span>
    @endif
</div>



<div class="has-warning form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>