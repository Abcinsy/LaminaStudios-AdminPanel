<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Program;
use Illuminate\Http\Request;

class InternshipProgramController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Internship Programs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Program());

        $grid->column('id', __('Id'));
        $grid->column('position', __('Position'));
        $grid->column('supervisor', __('Supervisor'));
        $grid->column('active_applicants', __('Active Applicants'));
        $grid->column('all_applicants', __('All Applicants'));
        $grid->column('status', __('Status'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Program::findOrFail($id));

        $show->column('id', __('Id'));
        $show->column('position', __('Position'));
        $show->column('supervisor', __('Supervisor'));
        $show->column('active_applicants', __('Active Applicants'));
        $show->column('all_applicants', __('All Applicants'));
        $show->column('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Program);

        $form->text('position', __('Position'));
        $form->text('supervisor', __('Supervisor'));
        $form->number('active_applicants', __('Active Applicants'));
        $form->number('all_applicants', __('All Applicants'));
        $form->select('status', __('Status'))->options([
            'active' => 'Active',
            'inactive' => 'Inactive'
        ]);

        return $form;
    }
}
