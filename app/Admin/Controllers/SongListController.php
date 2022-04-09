<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SongList;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SongListController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(SongList::indexQuery(), function (Grid $grid) {
            $grid->scrollbarX();
            $grid->column('id')
                ->display(function ($value) {
                return "<a class='btn btn-sm btn-primary ' style='color:#fff;' href='/admin/song?song_list_id={$value}'>查看歌曲</a>";
            });
            $grid->column('pic')
                ->image('', 150, 150);
            $grid->column('title');
            $grid->column('introduction')
                ->width(300)
                ->display(function ($val) {
                    return "<div style='height: 150px;overflow-y: scroll'>$val</div>";
                });
            $grid->column('style');
            $grid->column('create_by.name')->display(function ($val) {
                return $val ?? '无';
            } );
            $grid->column('create_date');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
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
        return Show::make($id, new SongList(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('pic');
            $show->field('introduction');
            $show->field('style');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SongList(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('pic');
            $form->text('introduction');
            $form->text('style');
        });
    }
}
