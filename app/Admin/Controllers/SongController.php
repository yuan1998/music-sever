<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Song;
use App\Models\Singer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SongController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Song::indexQuery(), function (Grid $grid) {
            $grid->scrollbarX();

            $grid->column('id')->sortable();
            $grid->column('pic')->image('', 100, 100);
//            $grid->column('singer_id');
            $grid->column('name');
            $grid->column('introduction');
            $grid->column('create_time');
            $grid->column('update_time');
            $grid->column('lyric')
                ->width(300)
                ->display(function ($val) {
                return "<div style='height: 150px;overflow-y: scroll'>$val</div>";
            });

            $grid->column('url');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name');
                if (!request()->has('singer_id') && !request()->has('song_list_id')) {
                    $filter->equal('singer_id')
                        ->select(Singer::all(['name', 'id'])
                            ->pluck('name', 'id'));
                }

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
        return Show::make($id, new Song(), function (Show $show) {
            $show->field('id');
            $show->field('singer_id');
            $show->field('name');
            $show->field('introduction');
            $show->field('create_time');
            $show->field('update_time');
            $show->field('pic');
            $show->field('lyric');
            $show->field('url');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Song(), function (Form $form) {
            $form->display('id');
//            $form->text('singer_id');
            $form->text('name');
            $form->text('introduction');
            $form->date('create_time');
            $form->file('pic')->autoUpload()
                ->removable(false);
            $form->textarea('lyric');
            $form->file('url')->autoUpload()->removable(false);
            $form->display('update_time');
        });
    }
}
