<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BannerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Banner::query()->orderBy('id', 'desc'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('path')->image('');
            $grid->column('comment');
            $grid->column('url');
            $grid->column('order');
            $grid->column('created_at');


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
        return Show::make($id, new Banner(), function (Show $show) {
            $show->field('id');
            $show->field('path')->image();
            $show->field('comment');
            $show->field('url');
            $show->field('order');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Banner(), function (Form $form) {
            $form->display('id');
            $form->ignore(['radio']);

            $form->radio('radio','图片选项')
                ->when([1, 4], function (Form $form) {
                    $form->image('path')
                        ->autoUpload(true)
                        ->removable(false);
                })
                ->when(2, function (Form $form) {
                    $form->text('path','网络链接');
                })
                ->options([
                    1 => '手动上传',
                    2 => '网络连接',
                ])
                ->default(2);



            $form->text('comment');
            $form->text('url');
            $form->number('order');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
