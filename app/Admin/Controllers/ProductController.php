<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Services\AdminControllerAssets;

class ProductController extends Controller
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
        $grid = new Grid(new Product);

        $grid->id('Id');
        $grid->title('Title');
        $grid->description('Description');
        $grid->color('Color');
        $grid->size('Size');
        $grid->price('Price');
        $grid->deleted_at('Deleted at');
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
        $show = new Show(Product::findOrFail($id));

        $show->id('Id');
        $show->title('Title');
        $show->description('Description');
        $show->color('Color');
        $show->size('Size');
        $show->price('Price');
        $show->deleted_at('Deleted at');
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
        $form = new Form(new Product);

        $form->registerBuiltinFields();

        $form->text('title', 'Title');
        $form->text('slug', 'slug');
        $form->textarea('description', 'Description');
        $form->text('color', 'Color');
        $form->text('size', 'Size');
        $form->text('price', 'Price');

        $form->hasMany('images', 'Images', function (Form\NestedForm $form) {
            $form->text('title');
            $form->text('alt');
            $form->image('url');
        });

        $form->multipleSelect('categories', 'Categories')->options(ProductCategory::all()->pluck('title', 'id'));

        return $form;
    }
}
