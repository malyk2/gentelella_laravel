@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Створення користувача</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{ route('user.saveUser') }}" method="post" autocomplete="nope">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Логін <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="name" class="form-control col-md-7 col-xs-12 {{ $errors->has('name') ? 'parsley-error' : '' }}" value="{{ old('name', '') }}">
                                    {!! formErrors('name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12 {{ $errors->has('email') ? 'parsley-error' : '' }}" autocomplete="nope" value="{{ old('email', '') }}">
                                    {!! formErrors('email') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Пароль <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12 {{ $errors->has('password') ? 'parsley-error' : '' }}" autocomplete="new-password">
                                    {!! formErrors('password') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Група</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control {{ $errors->has('group_id') ? 'parsley-error' : '' }}" name="group_id">
                                        <option value="">Виберіть групу</option>
                                        @php
                                            $traverse = function ($groups, $prefix = '') use (&$traverse) {
                                                foreach ($groups as $group) {
                                                    echo '<option value="'.$group->id.'"'.(old('group_id') == $group->id ? 'selected' : '').'>'.$prefix.' '.$group->name.'</option>';
                                                    $traverse($group->children, $prefix.'-');
                                                }
                                            };
                                            $traverse($groupsTree);
                                        @endphp
                                    </select>
                                    {!! formErrors('group_id') !!}
                                </div>
                            </div>
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