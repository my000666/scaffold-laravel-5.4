@php($method = isset($role->id) ? 'put' : 'post')
@php($route = isset($role->id) ? route('role.update', $role->id) : route('role.store'))
@php($index = route('role.index'))

{!! Form::model($role, ['url' => $route, 'method' => $method, 'id' => 'role-form']) !!}
<div class="row">
    <div class="col-md-4">
        <div class="form-group label-floating" v-bind:class="errors.display_name ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.display_name">@{{ errors.display_name[0] }}</span>
                <span v-else>Name</span>
            </label>
            {{ Form::text('display_name', old('display_name', $role->display_name), ['class' => 'form-control']) }}
            <span class="material-icons form-control-feedback">clear</span>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group label-floating" v-bind:class="errors.description ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.description">@{{ errors.description[0] }}</span>
                <span v-else>Description</span>
            </label>
            {!! Form::textarea('description', old('description', $role->description), ['class' => 'form-control', 'rows' => 1]) !!}
            <span class="material-icons form-control-feedback">clear</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating" v-bind:class="errors.permission ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.permission">@{{ errors.permission[0] }}</span>
                <span v-else>Permission</span>
            </label>
            {!! Form::select('permission[]', $permissions, old('permission', $permission), ['class' => 'form-control', 'multiple' => true, 'placeholder' => '']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group" v-bind:class="errors.mode ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.mode">@{{ errors.mode[0] }}</span>
                <span v-else>Mode</span>
            </label>
            <div class="radio">
                @foreach($modes as $key => $value)
                    <label class="radio-inline">
                    {!! Form::radio('mode', $key, $key == $mode) !!} {!! $value !!}
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript" src="{{ asset('/js/modal.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#role-form',
        data: {
            errors: []
        },
        methods: {
            submit: function(e) {
                axios({
                    method: '{!! $method !!}',
                    url: '{!! $route !!}',
                    data: $(e.currentTarget).serialize()
                })
                .then(function (response) {
                    if(response.data.errors) {
                        this.errors = response.data.errors;
                    } else {
                        window.location.href = '{!! $index !!}';
                    }
                }.bind(this));
            }
        }
    });
</script>