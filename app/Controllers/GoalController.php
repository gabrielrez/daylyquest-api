<?php

namespace App\Controllers;

use App\Core\Controller;

class GoalController extends Controller
{
  protected $model;

  public function __construct()
  {
    $this->model = $this->model('goal');
  }

  public function getAllByCollectionId($collection_id)
  {
    // Logic to list goals in a collection
  }

  public function create($collection_id)
  {
    // Logic to create a goal in a collection
  }

  public function info($collection_id, $goal_id)
  {
    $goal = $this->model->find('goals', $goal_id);
    dd($goal);
  }

  public function edit($collection_id, $goal_id)
  {
    // Logic to update goal
  }

  public function delete($collection_id, $goal_id)
  {
    // Logic to delete goal
  }

  public function complete($collection_id, $goal_id)
  {
    // Logic to mark goal as complete
  }
}
