<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Singer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SingerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Singer(), function (Grid $grid) {
            $grid->scrollbarX();
            $grid->column('id')->display(function ($value) {
                return "<a class='btn btn-sm btn-primary ' style='color:#fff;' href='/admin/song?singer_id={$value}'>查看歌曲</a>";
            });
            $grid->column('pic')->image('',100,100);
            $grid->column('name');
            $grid->column('sex')->using(\App\Models\Singer::$sex);
            $grid->column('birth');
            $grid->column('location');
            $grid->column('introduction')->width(300);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');
                $filter->equal('name')->select(\App\Models\Singer::$sex);
                $filter->like('location');
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
        return Show::make($id, new Singer(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('sex');
            $show->field('pic');
            $show->field('birth');
            $show->field('location');
            $show->field('introduction');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Singer(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('sex');
            $form->text('pic');
            $form->text('birth');
            $form->text('location');
            $form->text('introduction');
        });
    }
}
