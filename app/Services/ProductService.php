<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductService extends AppService
{
    public function all(Collection $collection)
    {
        return $this->apiRepository->all($collection);        
    }

    public function find(Model $model)
    {
        return $this->apiRepository->find($model);
    }

    public function store(array $data)
    {
        if(isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('');
        }
        $product = Product::create($data);
        return $this->apiRepository->find($product);
    }

    public function update(array $data, Product $product)
    {
        $product->fill([$data['name'], $data['description'], $data['quantity'], $data['seller_id']]);

        if (isset($data['status'])) {
            $product->status = $data['status'];

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->infoResponse('An active product must have at least one category', 409);
            }
        }

        if(isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            Storage::delete($product->image);
            $product->image = $data['image']->store('');
        }

        if (!$product->isDirty()) {
            return $this->infoResponse('You need to specify diff value to change', 422);
        }
        
        $product->save();

        return $this->apiRepository->find($product);
    }

    public function delete(Product $product)
    {
        Storage::delete($product->image);
        $product->delete();
        return $this->infoResponse('product deleted !', 200);
    }
}
