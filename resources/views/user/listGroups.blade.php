@extends('layouts.app')
{{-- @include('modules.fancytree') --}}
@include('modules.treetable')
@section('content')
@push('js')
<script>
    $(function(){
        $('.delete-item').on('click', function(e){
            e.preventDefault();
            new PNotify({
                title: 'Підтвердження',
                text: 'Ця дія видалить всі підгрупи та користувачів з групи і підгруп.<br>Ви впевнені?',
                icon: 'glyphicon glyphicon-question-sign',
                hide: true,
                confirm: {
                    confirm: true
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                },
                addclass: 'stack-modal',
                stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
                }).get().on('pnotify.confirm', function(){
                    window.location.href = $(e.currentTarget).attr('href');
                }).on('pnotify.cancel', function(){

                });
        });
        // $('#tree').fancytree({
        //     // checkbox: true,
        //     extensions: ["table"],
		// 	selectMode: 1,
		// 	activate: function(event, data){
		// 		// var node = data.node;
		// 		// FT.debug("activate: event=", event, ", data=", data);
		// 		// if(!$.isEmptyObject(node.data)){
		// 		// 	alert("custom node data: " + JSON.stringify(node.data));
		// 		// }
		// 	},
		// 	lazyLoad: function(event, data){
		// 		// we can't `return` values from an event handler, so we
		// 		// pass the result as `data.result` attribute:
		// 		// data.result = {url: "ajax-sub2.json"};
		// 	},
        // });
//         $('#treetable').fancytree({
//             extensions: ["table"],
//             selectMode: 1,
// //             fixed: {
// // 				fixCols: 4,	  // Fix leftmost n columns
// // //		        fixColWidths: [16, 50, 200],
// // 				fixRows: 2  // Fix topmost n rows (true: whole <thead>)
// // 			},
// 			table: {
// 				indentation: 20,	  // indent 20px per node level
// 				nodeColumnIdx: 2,	 // render the node title into the 2nd column
// 				checkboxColumnIdx: 0  // render the checkboxes into the 1st column
// 			},
//         });
        // $('#tree').fancytree({
        //     extensions: ["table"],
        // });
        // $(".treetable").treetable({
        //     expandable: true,
        // });
        $(".treetable").treetable({
            expandable: true,
        }).treetable("expandAll");
    });
</script>
@endpush
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        {{ Breadcrumbs::render('user.listGroups') }}
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Групи користувачів</h2>
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
                    <a href="{{ route('user.addGroup') }}" class="btn btn-round btn-primary" aria-label="Left Align">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    <div class="x_content">
                        <table class="treetable">
                            <tr data-tt-id="1">
                                <td>Parent1</td>
                            </tr>
                            <tr data-tt-id="2" data-tt-parent-id="1">
                                <td>Child1</td>
                            </tr>
                            <tr data-tt-id="3">
                                <td>Parent2</td>
                            </tr>
                            <tr data-tt-id="4" data-tt-parent-id="3">
                                <td>Child1</td>
                            </tr>
                        </table>
                        {{-- <div id="tree">
                            <ul id="treeData">
                                <li>1
                                    <ul>
                                        <li>11</li>
                                        <li>12</li>
                                        <li>13</li>
                                    </ul>
                                </li>
                                <li>
                                    2
                                </li>
                            </ul>
                        </div> --}}
                        {{-- <table id="treetable" class="table table-condensed table-hover table-striped fancytree-fade-expander">
                            <colgroup>
                                <col width="80px"></col>
                                <col width="30px"></col>
                                <col width="*"></col>
                                <col width="100px"></col>
                                <col width="100px"></col>
                                <col width="100px"></col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Classification</th>
                                    <th>Folder</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table> --}}
                        {{-- </div> --}}
                        {{-- <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $traverse = function ($groups, $prefix = '') use (&$traverse) {
                                        foreach ($groups as $group) {
                                            echo '<tr>';
                                            echo '<td>';
                                                echo $prefix.' '.$group->name;
                                                echo '<span class="label pull-right '.($group->active ? 'label-success' : 'label-danger').'">';
                                                    echo '<i class="fa '.($group->active ? 'fa-unlock' : 'fa-lock' ).'"></i>';
                                                echo '<span>';
                                            echo '</td>';
                                            echo '<td class="text-center">';
                                                if($group->canEdit() || $group->canDelete()){
                                                echo '<div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false"> <span class="caret"></span>
                                                        </button>
                                                    <ul role="menu" class="dropdown-menu">';
                                                        if($group->canEdit()) {
                                                            echo '<li><a href="'.route('user.editGroup', [$group->id]).'">Редагувати</button></li>';
                                                        }
                                                        if($group->canDelete()) {
                                                            echo '<li><a class="delete-item" href="'.route('user.deleteGroup', [$group->id]).'">Видалити</button></li>';
                                                        }
                                                    echo '</ul>
                                                    </div>';
                                                }
                                            echo '</td>';
                                            echo '</tr>';
                                            $traverse($group->children, $prefix.'-');
                                        }
                                    };
                                    $traverse($tree);
                                @endphp
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection