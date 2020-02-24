<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Models\Budget;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends AdminController{

	public function index(Budget $budget){
		$title      = $budget->name;
		$categories = $budget->categories()->orderBy('name')->get();

		$this->bread([
			route('admin.budgets.show', $budget->id)             => 'Budget',
			route('admin.budgets.categories.index', $budget->id) => 'Categories',
		]);

		return view('admin.categories.index', compact('budget', 'categories', 'title'));
	}

	public function create(Budget $budget){
		$title   = $budget->name;

		$this->bread([
			route('admin.budgets.show', $budget->id)              => 'Budget',
			route('admin.budgets.categories.index', $budget->id)  => 'Categories',
			route('admin.budgets.categories.create', $budget->id) => 'Add',
		]);

		return view('admin.categories.create', compact('budget', 'title'));
	}

	public function store(StoreCategoryRequest $request, Budget $budget){

		// Create category
		$category = Category::create($request->input());

		return redirect()->route('admin.budgets.categories.index', $budget->id)
		                 ->with('message', 'Nice work! You added the category <i>' . e($category->name) . '</i>')
		                 ->with('alertType', 'info');
	}

	public function show(Budget $budget, Category $category){
		dd($category->units_min);
	}

	public function edit(Budget $budget, Category $category){
		$title   = $budget->name;

		$this->bread([
			route('admin.budgets.show', $budget->id)             => 'Budget',
			route('admin.budgets.categories.index', $budget->id) => 'Categories',
			route('admin.budgets.categories.edit', $budget->id)  => 'Edit',
		]);

		return view('admin.categories.edit', compact('budget', 'title', 'category'));
	}

	public function update(UpdateCategoryRequest $request, Budget $budget, Category $category){

		// Create category
		$category->update($request->input());

		return redirect()->route('admin.budgets.categories.index', $budget->id)
		                 ->with('message', 'Nice work! You updated the category <i>' . e($category->name) . '</i>')
		                 ->with('alertType', 'info');

	}

	public function destroy(Budget $budget, Category $category){
		$category->delete();
		$categories = $budget->categories()->orderBy('name')->get();

		return view('admin.categories.sections.list', compact('budget', 'categories'));
	}

}
