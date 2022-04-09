<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\RankList;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class RankListController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new RankList(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('songListId');
            $grid->column('consumerId');
            $grid->column('score');
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new RankList(), function (Show $show) {
            $show->field('id');
            $show->field('songListId');
            $show->field('consumerId');
            $show->field('score');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new RankList(), function (Form $form) {
            $form->display('id');
            $form->text('songListId');
            $form->text('consumerId');
            $form->text('score');
        });
    }
}
