<?php

namespace App\Traits\Datatables;

trait TableConfiguration
{
    public int $index = 0;

    public function bootWithSorting()
    {
        $this->defaultSortColumn = 'id';
        $this->defaultSortDirection = 'desc';
    }

    public function initializeTableConfiguration()
    {
        $this->listeners = array_merge($this->listeners, [
            'refreshDatatable'  =>  'resetIndex'
        ]);
    }

    public function configure() : void
    {
        $this->setPrimaryKey('id');
//        $this->setBulkActionsEnabled();

        $this->setHideBulkActionsWhenEmptyEnabled();

//        $this->setBulkActions([
//            'deleteSelected' => 'Delete Selected',
//        ]);

        $this->setTableWrapperAttributes([
            'class' => '',
        ]);

        $this->setTrAttributes(function($row) {
            return [
                'class' => '',
            ];
        });

        $this->setThAttributes(function($row) {
            return [
                'class' => '',
            ];
        });

        $this->setTbodyAttributes([
            'class' => '',
        ]);
    }

    public function deleteSelected()
    {
        $this->emit('deleteAll',$this->getSelected());
    }

    public function resetIndex()
    {
        $this->index = 0;
    }

}
