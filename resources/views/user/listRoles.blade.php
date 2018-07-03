@extends('layouts.app')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.listRoles') }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Список ролей користувачів</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    {{-- <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <a href="{{ route('user.addRole') }}" class="btn btn-round btn-primary" aria-label="Left Align">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    <div class="x_content">
                        @if(count($roles))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th>Група</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            {{ $role->group->full_name }}
                                        </td>
                                        <td class="text-center">
                                            @if($role->canEdit() || $role->canDelete())
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        @if($role->canEdit())
                                                            <li>
                                                                <a href="{{ route('user.editRole', [$role->id]) }}">Редагувати</a>
                                                            </li>
                                                        @endif
                                                        @if($role->canDelete())
                                                            <li>
                                                                <a href="{{ route('user.deleteRole', [$role->id]) }}">Видалити</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection