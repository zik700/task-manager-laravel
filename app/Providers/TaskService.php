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

    public function updateOrCreateTask(int $task_id = null, string $name, string $description, $user_id, $from = null, boolean $is_done = null){

        $result = Tasks::updateOrCreate([
            'id' => $task_id
        ],[
            'name' => $name,
            'description' => $description,
            'is_done' => $is_done,
            'user_id' => $user_id,
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
        return Tasks::whereMonth('created_at', $thisMonth)->where('is_done', $state)->get()->count() ? Tasks::whereMonth('created_at', $thisMonth)->where('is_done', $state)->get()->count() : 0 ;

    }


    /**
     * Count daily unrealized tasks
     * int  $user_id - User $user_id
     */
    public function countDailyTasks(int $user_id){
        
        $today = date("Y-m-d");
        return Tasks::whereDate('created_at', $today)->where('is_done', false)->get()->count() ? Tasks::whereDate('created_at', $today)->where('is_done', false)->get()->count() : 0;

    }
}
