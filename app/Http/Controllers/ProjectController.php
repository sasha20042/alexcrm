<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Project;
 
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.


     */
    public function index()
    {
        $project = Project::orderBy('created_at', 'DESC')->get();
        $factorySpecialization = 'Factory Specialization Value'; // Замініть це значенням, яке ви хочете відобразити
        $workLocation = 'Work Location Value'; // Замініть це значенням, яке ви хочете відобразити
        $jobTitle = 'Job Title Value'; // Замініть це значенням, яке ви хочете відобразити
        $genderAgeRestrictions = 'Gender Age Restrictions Value'; // Замініть це значенням, яке ви хочете відобразити
        $shortDetails = 'Short Details Value'; // Замініть це значенням, яке ви хочете відобразити
        $productionChanges = 'Production Changes Value'; // Замініть це значенням, яке ви хочете відобразити
        $workingHours = 'Working Hours Value'; // Замініть це значенням, яке ви хочете відобразити
        $salary = 'Salary Value'; // Замініть це значенням, яке ви хочете відобразити
        $accommodationConditions = 'Accommodation Conditions Value'; // Замініть це значенням, яке ви хочете відобразити
        $mealConditions = 'Meal Conditions Value'; // Замініть це значенням, яке ви хочете відобразити
        $transportation = 'Transportation Value';
        $additionalExpenses = 'Additional Expenses'; // Замініть це значенням, яке ви хочете відобразити

        return view('project.index', compact('project', 'factorySpecialization', 'workLocation', 'jobTitle', 'genderAgeRestrictions', 'shortDetails', 'productionChanges', 'workingHours', 'salary', 'accommodationConditions', 'mealConditions', 'transportation', 'additionalExpenses'));
  
    }
  


    public function create()
    {
        return view('project.create');
    }

  
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
     {
         // Валідація для всіх категорій фото
         $request->validate([
             'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
             'housing_photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
             'production_photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
         ]);
     
         // Створюємо новий проект
         $project = Project::create($request->all());
     
         // Обробка і збереження фото загальної категорії (photos)
         if ($request->hasFile('photos')) {
             $photos = [];
             foreach ($request->file('photos') as $photo) {
                 $path = $photo->store('photos', 'public'); // Зберігаємо фото в папці 'public/photos'
                 $photos[] = $path;
             }
             $project->photos = json_encode($photos);
         }
     
         // Обробка і збереження фото житла (housing_photos)
         if ($request->hasFile('housing_photos')) {
             $housing_photos = [];
             foreach ($request->file('housing_photos') as $photo) {
                 $path = $photo->store('photos', 'public'); // Зберігаємо фото в тій самій папці 'public/photos'
                 $housing_photos[] = $path;
             }
             $project->housing_photos = json_encode($housing_photos);
         }
     
         // Обробка і збереження фото з місця виробництва (production_photos)
         if ($request->hasFile('production_photos')) {
             $production_photos = [];
             foreach ($request->file('production_photos') as $photo) {
                 $path = $photo->store('photos', 'public'); // Зберігаємо фото в тій самій папці 'public/photos'
                 $production_photos[] = $path;
             }
             $project->production_photos = json_encode($production_photos);
         }
     
         // Зберігаємо всі зміни
         $project->save();
     
         return redirect()->route('project')->with('success', 'Добавив, харош!');
     }
     
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
  
        return view('project.show', compact('project'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
  
        return view('project.edit', compact('project'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
  
        $project->update($request->all());
  
        return redirect()->route('project')->with('success', 'Оновив!');
    }
  public function fetchCompanies()
{
    $company = Project::select('id', 'company')->get();
    return response()->json($company);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
  
        $project->delete();
  
        return redirect()->route('project')->with('success', 'Видалив, ну і ок)');
    }
    public function fetchVacancies()
    {
        $vacancy = Project::select('id', 'vacancy')->get(); // Виберіть необхідні поля
        return response()->json($vacancy);
    }
}