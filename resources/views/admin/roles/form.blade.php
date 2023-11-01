<div class="row">
    <div class="form-group col-md-12 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $role->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <h6>Permissions</h6>
    <div class="row">
        @foreach($permissionGroup as $key => $permissions)
            <div class="col-lg-6">
                <div class="mb-3">
                    <p class="fw-semibold">{{ ucfirst($key) }}</p>
                    <div class="border px-3 pt-3 pb-2 rounded">
                        <div class="row">
                            @foreach($permissions as $permission)
                            <div class="col-md-6">
                                <label class="form-check mb-2">
                                    <input 
                                        type="checkbox"
                                        required="required" 
                                        class="form-check-input form-check-input-secondary" 
                                        name="permission[]" 
                                        value="{{ $permission['id'] }}" 
                                        @if(isset($permission['exist'])) {{ $permission['exist'] }} @endif>
                                    <span class="form-check-label">{{ ucfirst($permission['name']) }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>