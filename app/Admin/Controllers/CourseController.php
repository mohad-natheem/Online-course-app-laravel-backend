<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use App\Models\CourseType;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CourseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Course';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Course());

        $grid->column('id', __('Id'));
        $grid->column('user_token', __('Teacher'))->display(function($token){
            //for further processing data you can create method inside the display function
            return User::where('token',"=",$token)->value('name');
        });
        $grid->column('name', __('Name'));
        //70,70 refers to the image size
        $grid->column('thumbnail', __('Thumbnail'))->image('',50,50);
        $grid->column('description', __('Description'));
        $grid->column('type_id', __('Type id'));
        $grid->column('price', __('Price'));
        $grid->column('lesson_num', __('Lesson num'));
        $grid->column('video_length', __('Video length'));

        $grid->column('created_at', __('Created at'));


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Course::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('thumbnail', __('Thumbnail'))->image('',60,60);
        $show->field('video', __('Video'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('lesson_num', __('Lesson num'));
        $show->field('video_length', __('Video length'));
        $show->field('follow', __('Follow'));
        $show->field('score', __('Score'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Course());
        $form->text('name', __('Name'));

        //get our categories
        //key value pair
        //last one is the key
        $result = CourseType::pluck('title','id');

        $form->select('type_id',__('Category'))->options($result);
        $form->image('thumbnail', __('Thumbnail'))->uniqueName();
        $form->file('video', __('Video'))->uniqueName();
        $form->textarea('description', __('Description'));
        $form->decimal('price', __('Price'));
        $form->number('lesson_num', __('Lesson num'));
        $form->number('video_length', __('Video length'));
        $form->display('created_at',__('Created At'));
        $form->display('deleted_at',__('Deleted At'));

        //to know who is posting it will be stoed in user token
        $result=User::pluck('name','token');
        $form->select('user_token',__('Teacher'))->options($result);

        return $form;
    }
}
