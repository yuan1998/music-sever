<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Comment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CommentController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Comment(), function (Grid $grid) {
            $grid->scrollbarX();

            $grid->column('id')->sortable();
            $grid->column('user_id');
            $grid->column('song_id');
            $grid->column('song_list_id');
            $grid->column('content')->width(300);
            $grid->column('create_time');
            $grid->column('type');
            $grid->column('up');

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
        return Show::make($id, new Comment(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('song_id');
            $show->field('song_list_id');
            $show->field('content');
            $show->field('create_time');
            $show->field('type');
            $show->field('up');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Comment(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('song_id');
            $form->text('song_list_id');
            $form->text('content');
            $form->text('create_time');
            $form->text('type');
            $form->text('up');
        });
    }
}
