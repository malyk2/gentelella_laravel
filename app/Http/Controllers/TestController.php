<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    public function index()
    {
        // $root = new Test();
        // $root->name = 'root';
        // $root->save();

        // $root = Test::find(1);

        // $root->appendToNode(Test::create())->save();
        // $root->children()->create(['name' => 'name1']);
        // $root->children()->create(['name' => 'name2']);

        // $name1 = Test::find(2);
        // $name1->children()->create(['name' => 'name11']);
        // $name1->children()->create(['name' => 'name12']);


        // dd($root->ancestors);
        // dd($root->descendants);
        // dd($root);
        // dd($root->children);


        // dd('stop');

        // $tree = Test::descendantsAndSelf(1)->toTree();
        // // $tree = Test::descendantsOf(1)->toTree(1);
        // $traverse = function ($categories, $prefix = '-') use (&$traverse) {
        //     foreach ($categories as $category) {
        //         echo "<br>".$prefix.' '.$category->name;

        //         $traverse($category->children, $prefix.'-');
        //     }
        // };
        // $traverse($tree);


        // dd('stop');
        // dd($tree);

    }
}
