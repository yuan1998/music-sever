<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Consumer;
use App\Models\Singer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ConsumerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Consumer(), function (Grid $grid) {
            $grid->scrollbarX();

            $grid->column('id')->sortable();
            $grid->column('avator')->image('', 150, 150);
            $grid->column('username');
            $grid->column('sex')->using(Singer::$sex);
            $grid->column('phone_num');
            $grid->column('email');
            $grid->column('birth');
            $grid->column('introduction');
            $grid->column('location');
            $grid->column('create_time');
            $grid->column('update_time');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('sex')->select(Singer::$sex);
                $filter->like('username');
                $filter->like('phone_num');
                $filter->like('email');

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
        return Show::make($id, new Consumer(), function (Show $show) {
            $show->field('id');
            $show->field('username');
            $show->field('password');
            $show->field('sex');
            $show->field('phone_num');
            $show->field('email');
            $show->field('birth');
            $show->field('introduction');
            $show->field('location');
            $show->field('avator');
            $show->field('create_time');
            $show->field('update_time');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Consumer(), function (Form $form) {
            $userTable = 'consumer';


            $id = $form->getKey();

            $form->display('id', 'ID');

            $form->text('username', __('username'))
                ->required()
                ->creationRules(['required', "unique:{$userTable}"])
                ->updateRules(['required', "unique:{$userTable},username,$id"]);


            if ($id) {
                $form->password('password', trans('admin.password'))
                    ->minLength(5)
                    ->maxLength(20)
                    ->customFormat(function () {
                        return '';
                    });
            } else {
                $form->password('password', trans('admin.password'))
                    ->required()
                    ->minLength(5)
                    ->maxLength(20);
            }
            $form->password('password_confirmation', trans('admin.password_confirmation'))->same('password');


            $form->image('avator', __('avator'))->autoUpload();
            $form->date('birth', __('birth'));
            $form->radio('sex', __('sex'))->options(\App\Models\Consumer::SEX_LIST);
            $form->text('phone_num', __('phone_num'));
            $form->email('email', __('email'));
            $form->textarea('introduction', __('introduction'));
            $form->text('location', __('location'));


            $form->ignore(['password_confirmation']);


            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));


        })->saving(function (Form $form) {
            if ($form->password && $form->model()->get('password') != $form->password) {
                $form->password = bcrypt($form->password);
            }

            if (! $form->password) {
                $form->deleteInput('password');
            }
        });
    }
}
