<?php

namespace App\Controllers;

use App\Core\Controller;

class CollectionController extends Controller
{
  protected $model;
  protected $table = 'collections';

  public function __construct()
  {
    $this->model = $this->model('collections');
  }

  public function get()
  {
    // Add authentication logic
    $this->model->all($this->table, ['title', 'description', 'cycle']);
  }

  public function create()
  {
    // Add authentication logic
    $user_id = 1;

    // Data comming from form
    $title = 'Dayly Goals';
    $description = 'Description of the collection';
    $cycle = '24 hours';

    if (empty($title) || empty($cycle)) {
      $this->response(['message' => 'All fields are required'], 400);
      return;
    }

    $collection = [
      'title' => htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
      'description' => htmlspecialchars($description, ENT_QUOTES, 'UTF-8'),
      'cycle' => $cycle,
      'user_id' => 1 // Authenticated user
    ];

    try {
      $this->model->insert($this->table, $collection);
      $this->response(['message' => 'Collection registered successfully'], 201);
    } catch (\Exception $e) {
      $this->response(['message' => 'Failed to register collection'], 500);
    }
  }

  public function info($collection_id)
  {
    // Add authentication logic
    $collection = $this->model->find($this->table, ['*'], ['id' => $collection_id]);
    if (!$collection) {
      $this->response(['message' => 'Collection not found'], 404);
      return;
    }
    $this->response($collection[0]);
  }

  public function edit($collection_id)
  {
    // Logic to update collection
  }

  public function delete($collection_id)
  {
    if (empty($collection_id) || !is_numeric($collection_id)) {
      $this->response(['message' => 'Invalid collection ID'], 400);
      return;
    }

    try {
      $this->model->delete($this->table, $collection_id);
      $this->response(['message' => 'Collection deleted successfully'], 200);
    } catch (\Exception $e) {
      $this->response(['message' => 'Failed to delete collection', 'error' => $e->getMessage()], 500);
    }
  }
}
