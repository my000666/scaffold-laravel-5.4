@php($method = isset($user->id) ? 'put' : 'post')
@php($route = isset($user->id) ? route('user.update', $user->id) : route('user.store'))
@php($index = route('user.index'))

{!! Form::model($user, ['url' => $route, 'method' => $method, 'id' => 'user-form']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating" v-bind:class="errors.name ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.name">@{{ errors.name[0] }}</span>
                <span v-else>Name</span>
            </label>
            {{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}
            <span class="material-icons form-control-feedback">clear</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group label-floating" v-bind:class="errors.email ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.email">@{{ errors.email[0] }}</span>
                <span v-else>Email</span>
            </label>
            {!! Form::textarea('email', old('email', $user->email), ['class' => 'form-control', 'rows' => 1]) !!}
            <span class="material-icons form-control-feedback">clear</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating" v-bind:class="errors.role ? 'has-error' : ''">
            <label class="control-label">
                <span v-if="errors.role">@{{ errors.role[0] }}</span>
                <span v-else>Role</span>
            </label>
            {!! Form::select('role', $roles, old('role', $role), ['class' => 'form-control', 'placeholder' => '']) !!}
            <span class="material-icons form-control-feedback">clear</span>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript" src="{{ asset('/js/modal.js') }}"></script>
<script>
    var vm = new Vue({
        el: '#user-form',
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