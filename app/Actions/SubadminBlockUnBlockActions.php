<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class SubadminBlockUnBlockActions extends AbstractAction
{
    public function getTitle()
    {
        // return 'Block';
        return $this->data->{'is_blocked'}==1?'Unblock':'Block';
    }

    public function getIcon()
    {
        // return 'voyager-cannon';
        return $this->data->{'is_blocked'}==1?'voyager-x':'voyager-cannon';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right ',
            'style' => "margin-right : 5px;"
        ];
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }

    public function getDefaultRoute()
    {
        if($this->data->{'is_blocked'}==1)
        return route('admin-unblock-subadmin' , ['id' => $this->data->id]);
        else
        return route('admin-block-subadmin' , ['id' => $this->data->id]);
    }
}