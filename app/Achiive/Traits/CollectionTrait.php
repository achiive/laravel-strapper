<?php
namespace App\Achiive\Traits;

trait CollectionTrait
{

    /**
     * Returns the collection of rows from the model.
     * Can use the following properties:
     * - `$defaultModel`
     * - `$defaultTransformer`
     * - `$filterRequests` if `scopeFilterRequest()` is present
     * - `$join`
     *
     * @return  array
     */
    public function collection()
    {
        // Check we got a model first and to quit early if not
        if (!property_exists($this, 'defaultModel')) {
            abort('500', 'No `$defaultModel` property defined');
        }

        // Get the model from the controller
        $model = new $this->defaultModel;
        
        // Join up methods using with
        if (property_exists($this, 'join') && $this->join > 0) {
            foreach ($this->join as $method) {
                $model = $model->with($method);
            }
        }

        // Filter the requests if the method is avaliable
        if (method_exists($this->defaultModel, 'scopeFilterRequest')) {
            $model = $model->filterRequest();
        }

        // Get all the records and make it an array
        $data = $model->get()->toArray();
        if (property_exists($this, 'defaultTransformer') && !empty($this->defaultTransformer)) {
            $data = $this->defaultTransformer->transformCollection($data);
        }

        return $data;
    }
}
