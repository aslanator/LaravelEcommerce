<?php

namespace App\Admin\Controllers;

use App\Options;
use App\Http\Controllers\Controller;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OptionsController extends Controller
{
    use HasResourceActions;

    public function __construct(Admin $admin)
    {
        $admin::js(asset('/js/admin/icheck.js'));
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content, Admin $admin)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Options);

        $grid->id('Id');
        $grid->name('Name');
        $grid->value('Value');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(Options::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->value('Value');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Options);

        $form->registerBuiltinFields();
        $form->text('name', 'Name');
        $form->textarea('value', 'Value');

        return $form;
    }
}
