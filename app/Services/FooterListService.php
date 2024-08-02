<?php
namespace App\Services;

use App\Models\API\V1\Admin\FooterList;

class FooterListService
{
    public function createList($title, $lists, $href)
    {
        $footerList = new FooterList(); 
        $footerList->title = $title;
        $footerList->lists = $lists;
        $footerList->href = $href;
        $footerList->save(); 
    
        return $footerList;
    }

    public function showFooterLists()
    {
        return FooterList::all();
    }

    public function updateLists($id, $title, $lists, $href)
    {
        $updateLists = FooterList::find($id);
        if (!$updateLists) {
            return false;
        }
    
        $data = [
            'title' => $title,
            'lists' => $lists,
            'href' => $href
        ];
    
        if ($updateLists->update($data)) {
            return $updateLists;
        } else {
            return false;
        }
    }

    public function deleteFooterLists($id) 
    {
        $lists = FooterList::find($id);
        if ($lists) {
            return $lists->delete();
        }
        return false;
    }
}