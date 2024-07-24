<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Applicant;
use App\Models\Program;
use Illuminate\Http\Request;

class ApplicantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Applicants';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Applicant());

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First Name'));
        $grid->column('last_name', __('Last Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('email', __('Email'));
        $grid->column('position', __('Position'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Applicant::findOrFail($id));

        $show->column('id', __('Id'));
        $show->column('first_name', __('First Name'));
        $show->column('last_name', __('Last Name'));
        $show->column('phone', __('Phone'));
        $show->column('email', __('Email'));
        $show->column('position', __('Position'));
        $show->column('status', __('Status'));
        $show->column('created_at', __('Created at'));
        $show->column('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Applicant);

        // Fetch the active positions from the Program model
        $positions = Program::where('status', 'active')->pluck('position', 'position')->toArray();

        $form->text('first_name', __('First Name'));
        $form->text('last_name', __('Last Name'));
        $form->text('phone', __('Phone'));
        $form->email('email', __('Email'));
        $form->select('position', __('Position'))->options($positions);        
        $form->select('status', __('Status'))->options([
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected'
        ]);

        return $form;
    }
}
