<?php

namespace App\Controllers;

use App\Core\Controller;

class CollectionController extends Controller
{
  protected $model;

  public function __construct()
  {
    $this->model = $this->model('collection');
  }

  public function getAll()
  {
    // Logic to list all collections of the authenticated user
  }

  public function create()
  {
    // Logic to create a new collection
  }

  public function info($collection_id)
  {
    $collection = $this->model->find('collections', $collection_id);
    dd($collection);
  }

  public function edit($collection_id)
  {
    // Logic to update collection
  }

  public function delete($collection_id)
  {
    // Logic to delete collection
  }
}
