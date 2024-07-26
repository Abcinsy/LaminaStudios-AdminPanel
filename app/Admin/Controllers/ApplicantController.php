<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Applicant;
use App\Models\Program;

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

        // Fetch distinct positions
        $positions = Program::select('position')->distinct()->pluck('position', 'position');

        $grid->column('id', __('Id'));
        $grid->column('first_name', __('First Name'));
        $grid->column('last_name', __('Last Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('email', __('Email'));
        $grid->column('position', __('Position'));

        // Apply color to status column
        $grid->column('status', __('Status'))->display(function ($status) {
            $class = '';
            switch ($status) {
                case 'approved':
                    $class = 'status-approved';
                    break;
                case 'rejected':
                    $class = 'status-rejected';
                    break;
                case 'pending':
                    $class = 'status-pending';
                    break;
            }
            return "<span class='$class'>$status</span>";
        });

        // Format the created_at column
        $grid->column('created_at', __('Created at'))->display(function ($createdAt) {
            return \Carbon\Carbon::parse($createdAt)->format('Y-m-d');
        });

        // Hide the column by default
        $grid->column('updated_at', __('Updated at'))->hide();

        // Filter by search term, position, and status
        $grid->model()->when(request('search'), function ($query) {
            $search = request('search');
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
        });

        $grid->model()->when(request('position'), function ($query) {
            $position = request('position');
            $query->where('position', $position);
        });

        $grid->model()->when(request('status'), function ($query) {
            $status = request('status');
            $query->where('status', $status);
        });

        // Grid model for filtering
        $grid->header(function ($query) use ($positions) {
            return view('admin.table.applicant.applicant-filter', compact('positions'));
        });

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
        $show = new Show(Applicant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('first_name', __('First Name'));
        $show->field('last_name', __('Last Name'));
        $show->field('phone', __('Phone'));
        $show->field('email', __('Email'));
        $show->field('position', __('Position'));
        $show->field('status', __('Status'));
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
