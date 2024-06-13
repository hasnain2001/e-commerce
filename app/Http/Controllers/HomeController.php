<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Coupons;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
      public function index() {
    $stores = Stores::latest()->paginate(15);
    $categories = Categories::all();
    $blogs = Blog::latest()->paginate();
    $home = Blog::latest()->paginate();
      $Coupons = Coupons::latest()->paginate(15);
    return view('home', compact('stores', 'categories', 'blogs','Coupons','home'));
}
public function topStores(Request $request)
{
    $topstores = Stores::latest()->paginate(30); // Assuming your store model is named Store

    return view('home', compact('topstores'));
}
    
       public function search(Request $request) {
        $query = $request->input('query');
    
        // Check if there is a store with a matching name
        $store = Stores::where('name', $query)->first();
    
        if ($store) {
            // If a store is found, redirect to the store details page
            return redirect()->route('store.details', ['name' => $store->name]);
        }
    
    
        // If no store or category is found, display the regular search results page
        $stores = Stores::where('name', 'like', "$query%")->latest()->get();
    
        return view('search_results', compact('stores'));
    }
    

    public function stores(Request $request)
{
    $letter = $request->input('letter');
    $storesQuery = Stores::query();

    if ($letter) {
        $storesQuery->where('name', 'like', $letter.'%');
    }

    $stores = $storesQuery->orderBy('name')->paginate(1000);

    return view('stores', compact('stores'));
}
    public function blog() {
        $store = Blog::all();
        return view('Blog', compact('blog'));
    }
 
    public function StoreDetails($name, Request $request) {
        $slug = Str::slug($name);
        $title = ucwords(str_replace('-', ' ', $slug));
        $store = Stores::where('slug', $title)->first();
    
        // Sort coupons based on query parameter
        $sort = $request->query('sort', 'all');
    
        if ($sort === 'codes') {
            $coupons = Coupons::where('store', $title)->whereNotNull('code')->orderByRaw('CAST(`order` AS SIGNED) ASC')->get();
        } elseif ($sort === 'deals') {
            $coupons = Coupons::where('store', $title)->whereNull('code')->orderByRaw('CAST(`order` AS SIGNED) ASC')->get();
        } else {
            $coupons = Coupons::where('store', $title)->orderByRaw('CAST(`order` AS SIGNED) ASC')->get();
        }
    
        $codeCount = Coupons::where('store', $title)->whereNotNull('code')->count();
        $dealCount = Coupons::where('store', $title)->whereNull('code')->count();
    
        $blogs = Blog::all();
    
        // Fetch related stores
        $relatedStores = Stores::where('category', $store->category)
                               ->where('id', '!=', $store->id)
                               ->get();
    
        return view('store_details', compact('store', 'coupons', 'relatedStores', 'blogs', 'codeCount', 'dealCount'));
    }
    

     public function categories() {
        $categories = Categories::all();
        return view('categories', compact('categories'));
    }
      public function popularcategories() {
        $category = Categories::all();
        return view('categories', compact('category'));
    }
   
public function viewcategory($title)
{
    // Convert the meta tag to a slug
    $slug = Str::slug($title);
    
    // Convert the slug back to title case
    $name = ucwords(str_replace('-', ' ', $slug));
    
    // Retrieve stores related to the category
    $stores = Stores::where('category', $name)->get();
    
    // Retrieve all categories
    $categories = Categories::all();

    // Count the number of stores
    $storeCount = $stores->count();

    // Pass the stores, category name, categories, and store count to the view
    return view('related_categories', compact('stores', 'name', 'categories', 'storeCount'));
}


    
}
