@extends('layouts.app')
@include('modules.iCheck')
@section('content')
@push('js')
<script>
    $(function(){
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        {{-- {{ Breadcrumbs::render('user.listGroups') }} --}}
        {{ Breadcrumbs::render('user.editAddGroup', ! empty($item) ? $item : null) }}
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ empty($item) ? 'Створення' : 'Редагування' }} групи користувачів</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('user.saveGroup', [ ! empty($item) ? $item->id : null ]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Назва <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ ! empty($item) ? $item->name : '' }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Батьківська група</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control {{ $errors->has('parent_id') ? 'parsley-error' : '' }}" {{ ! empty($item) ? 'disabled' : '' }} name="parent_id">
                                        @if( ! empty($item) && $item->parent->isRoot())
                                            <option value="{{ $item->parent->id }}">{{ $item->parent->name }}</option>
                                        @else
                                        @php
                                            $item = ! empty($item) ? $item : null;
                                            $traverse = function ($groups, $prefix = '') use (&$traverse, $item) {
                                                foreach ($groups as $group) {
                                                    echo '<option value="'.$group->id.'"'.( ! empty($item) && $item->parent_id == $group->id ? 'selected' : '' ).'>'.$prefix.' '.$group->name.'</option>';
                                                    $traverse($group->children, $prefix.'-');
                                                }
                                            };
                                            $traverse($tree);
                                        @endphp
                                        @endif
                                    </select>
                                    {!! formErrors('parent_id') !!}
                                </div>
                            </div>
                            @can('manage', \App\Permission::class)
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Доступи
                                </label>
                                @if(count($permissions))
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <ul class="list-unstyled">
                                        @foreach($permissions as $perm)
                                        <li>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat" name="perms[{{ $perm->id }}]" {{ ! empty($item) && $item->permissions->contains('id', $perm->id) ? 'checked' : '' }} value="true"> {{ $perm->display_name }}
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            @endcan
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Зберегти</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection