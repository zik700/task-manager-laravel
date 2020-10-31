<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tasks;

class TaskService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function updateOrCreateTask(int $task_id = null, string $deadline,  string $name, string $description, $user_id, $from = null, boolean $is_done = null, $progress){

        $result = Tasks::updateOrCreate([
            'id' => $task_id
        ],[
            'name' => $name,
            'description' => $description,
            'is_done' => $is_done,
            'deadline' => $deadline,
            'progress'=> $progress,
            'user_id' => 1,
            'from' => $from
        ]);

        if (!$result){
            return false;
        }

        return true;
        
    }

    public function taskRealize($id, $is_done){

        $task = Tasks::find($id);

        if (empty($task)){
            return false;
        }

        $task->is_done = $is_done;
        $task->save();
        return true;

    }

    public function deleteTask($task_id){
        return Tasks::find($task_id)->delete();
    }

    /**
     * Count how many tasks are active today for $user_id
     * $user_id - User $user_id
     */
    public function countMonthlyTasks(int $user_id){
        
        $thisMonth = date("m");
        return Tasks::whereMonth('created_at', $thisMonth)->get()->count() ? Tasks::whereMonth('created_at', $thisMonth)->get()->count() : 0;

    }

    /**
     * Count tasks in current month by state
     * int  $user_id - User $user_id
     * string $state - active = true; done = false
     */
    public function countThisMonth(int $user_id, string $state){

        $thisMonth = date("m");
        return Tasks::whereMonth('updated_at', $thisMonth)->where('is_done', $state)->get()->count() ? Tasks::whereMonth('created_at', $thisMonth)->where('is_done', $state)->get()->count() : 0 ;

    }


    public function getDailyDone(){

        $today = date("Y-m-d");
        $result = Tasks::whereDate('updated_at', $today)
            ->where('is_done', true)
            ->get()
            ->count();

        return $result ? $result : 0;
    }
    
    public function getDailyCreated(){

        $today = date("Y-m-d");
        $result = Tasks::whereDate('created_at', $today)
            ->get()
            ->count();

        return $result ? $result : 0;
    }
    public function getMonthlyDone(){

        $thisMonth = date("m");
        $result = Tasks::whereMonth(
            'created_at', $thisMonth)
            ->where('is_done', true)
            ->get()
            ->count();

        return $result ? $result : 0;
        
    }
    public function getMonthlyCreated(){

        $thisMonth = date("m");
        $result = Tasks::whereMonth(
            'created_at', $thisMonth)
            ->get()
            ->count();
            
        return $result ? $result : 0;

        
    }

}
