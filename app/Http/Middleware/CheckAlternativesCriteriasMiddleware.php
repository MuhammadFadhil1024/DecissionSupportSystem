<?php

namespace App\Http\Middleware;

use App\Models\Alternative;
use Closure;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAlternativesCriteriasMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        $categoriesId = $request->route('categories_id');

        // dd($categoriesId);

        $category = Category::with('criteria')->find($categoriesId);
        $alternative = Category::with('alternatives.values')->find($categoriesId);
        // dd($category->criteria()->exists());
        if ($category->criteria()->exists()) {
            if ($alternative->alternatives()->exists()) {
                foreach ($alternative->alternatives as $value) {
                    if ($value->values()->exists() == false) {
                        return redirect()->back()->with('error', "This alternatives doesn't have value");
                    }
                    // dd($value->values()->exists());
                }
                return $next($request);
            }
            return redirect()->back()->with('error', "This category doesn't have alternatives");
        } else {
            return redirect()->back()->with('error', "This category doesn't have criteria");
        }
    }
}
