<?php

if(!function_exists('categoryNameByids')){


    function categoryNameByids($ids)
    {

        $cat=explode(',',$ids);
        $cat_names = App\Models\Category::select("*")
                ->whereIn('id', $cat)
                ->pluck('name')->toArray();
        $catNames=implode(',',$cat_names);
        return $catNames;
    }

}