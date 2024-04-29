<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPost;
use Illuminate\Support\Facades\View;
use Symfony\Component\Finder\Finder;
use App\Models\AdAndVideo;
use App\Models\ShortVideo;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; 
use Illuminate\Support\Facades\Log;


class BaseController extends Controller
{

  


    public function fetchExchangeRate()
    {
        try {
            $apiKey = config('api.exchangeratesapi.access_key');
            $response = Http::get("http://api.exchangeratesapi.io/v1/latest?access_key=$apiKey");
            $exchangeRate = $response->json();

            if (!isset($exchangeRate['rates']['USD'])) {
                throw new \Exception("USD exchange rate not found in API response");
            }

            return ['exchangeRate' => $exchangeRate, 'error' => null];
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error("Error fetching exchange rate: {$e->getMessage()}");

            // Return an error flag
            return ['exchangeRate' => null, 'error' => 'Failed to fetch exchange rate. Please try again later.'];
        }
    }

    public function index()
    {
        //
         // Fetch the exchange rate
         $exchangeRateData = $this->fetchExchangeRate();

         // Extract exchange rate from data
         $exchangeRate = $exchangeRateData['exchangeRate'];
 
        $newsPostsFooter = NewsPost::all();
        View::share('newsPostsFooter', $newsPostsFooter);
        return view('base.base', [
            'exchangeRate' => $exchangeRate, 
        ]); 
    }


    // the search functionality method
    public function searchStorage(Request $request)
{
    $searchTerm = $request->input('search');

    $results = [];

    // Defining the directory to search (using relative path)
    $directoryToSearch = storage_path(); // You can adjust this path as needed

    // Initialize Finder
    $finder = new Finder();

    // Search files
    $finder->files()->in($directoryToSearch)->contains($searchTerm);

    // Iterate through search results
    foreach ($finder as $file) {
        $results[] = $file->getRealPath();
    }

    return view('search', ['results' => $results]);
}


public function search(Request $request)
{
    
    $searchTerm = $request->input('search');

    // Implement your search logic here
    $newsResults = NewsPost::where('title', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('content', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('category', 'LIKE', '%' . $searchTerm . '%')
        ->get();

    $adResults = AdAndVideo::where('title', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')->get();

    $categoryResults = Category::where('name', 'LIKE', '%' . $searchTerm . '%')->get();

    $shortVideoResults = ShortVideo::where('title', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')->get();

    // Merge all results into a single array for simplicity
    $allResults = [
        'newsResults' => $newsResults,
        'adResults' => $adResults,
        'categoryResults' => $categoryResults,
        'shortVideoResults' => $shortVideoResults
    ];

    // Check if any results were found
    $isEmpty = collect($allResults)->every(function ($result) {
        return $result->isEmpty();
    });

    return view('search', [
        'isEmpty' => $isEmpty,
        'results' => $allResults,
        'searchTerm' => $searchTerm,
    ]);
}


    /**
     * Display a listing of the resource.
     */
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
