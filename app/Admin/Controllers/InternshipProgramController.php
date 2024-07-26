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
        $grid->column('active_applicants', __('Active Applicants'))->display(function () {
            return $this->active_applicants; });
        $grid->column('all_applicants', __('All Applicants'))->display(function () {
            return $this->all_applicants; });

        // Apply color to status column
        $grid->column('status', __('Status'))->display(function ($status) {
            $class = '';
            switch ($status) {
                case 'active':
                    $class = 'status-approved';
                    break;
                case 'inactive':
                    $class = 'status-rejected';
                    break;
            }
            return "<span class='$class'>$status</span>";
        });

        // Filter by search term and status
        $grid->model()->when(request('search'), function ($query) {
            $search = request('search');
            $query->where('position', 'like', "%{$search}%")
                  ->orWhere('supervisor', 'like', "%{$search}%");
        });

        $grid->model()->when(request('status'), function ($query) {
            $status = request('status');
            $query->where('status', $status);
        });

        // Grid model for the table header
        $grid->header(function ($query) {
            return view('admin.table.internship.internship-filter');
        });

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
        $show->column('active_applicants', __('Active Applicants'))->as(function () {
            return $this->active_applicants;
        });
        $show->column('all_applicants', __('All Applicants'))->as(function () {
            return $this->all_applicants;
        });
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
        $form->select('status', __('Status'))->options([
            'active' => 'Active',
            'inactive' => 'Inactive'
        ]);

        return $form;
    }
}
