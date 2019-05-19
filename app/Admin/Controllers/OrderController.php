<?php

namespace App\Admin\Controllers;

use App\Order;
use App\Http\Controllers\Controller;
use App\Product;
use App\Services\AdminControllerAssets;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderController extends Controller
{
    use HasResourceActions;

    /**
     * Добавляет css и js файлы
     * @param AdminControllerAssets $assets
     */
    public function __construct(AdminControllerAssets $assets)
    {
        $assets->addAssets();
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
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
        $grid = new Grid(new Order);

        $grid->id('Id');
        $grid->user_id('User id');
        $grid->pay_type('Pay type');
        $grid->address('Address');
        $grid->phone('Phone');
        $grid->email('Email');
        $grid->notes('Notes');
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
        $show = new Show(Order::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->pay_type('Pay type');
        $show->address('Address');
        $show->phone('Phone');
        $show->email('Email');
        $show->notes('Notes');
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
        $form = new Form(new Order);
        $form->registerBuiltinFields();

        $user = [];
        $userDB = config('admin.database.users_model')::all()->all();

        foreach($userDB as $item){
            $user[$item->id] = $item->username;
        }


        $form->select('user_id', 'User id')->options($user);
        $form->text('pay_type', 'Pay type');
        $form->text('address', 'Address');
        $form->text('phone', 'Phone');
        $form->email('email', 'Email');
        $form->textarea('notes', 'Notes');
        $form->select('payed', 'Payed')->options(['0' => 'N', '1' => 'Y']);
        $form->select('complete', 'Complete')->options(['0' => 'N', '1' => 'Y']);

        $form->multipleSelect('products')->options(Product::all()->pluck('title', 'id'));

        return $form;
    }
}
