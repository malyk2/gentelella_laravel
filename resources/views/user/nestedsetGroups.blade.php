@php
$traverse = function ($categories, $prefix = '-') use (&$traverse) {
    foreach ($categories as $category) {
        echo "<br>".$prefix.' '.$category->name;
            $traverse($category->children, $prefix.'-');
    }
};
$traverse($tree);
@endphp
