<?php

namespace App\Services;

use App\Models\Seller;
use App\Models\Product;
use App\Services\AppService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerService extends AppService
{
    public function all(Collection $collection)
    {
        return $this->apiRepository->all($collection);        
    }
    
    public function store(array $data, Seller $seller)
    {
        if(isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('');
        }
        $data['seller_id'] = $seller->id;
        $product = Product::create($data);

        return $this->apiRepository->find($product);
    }

    public function update(array $data, Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);

        $product->fill([
            'name' => $data['name'] ?? $product->name,
            'description' => $data['description'] ?? $product->description,
            'quantity' => $data['quantity'] ?? $product->quantity
        ]);

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

    public function delete(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);
        Storage::delete($product->image);
        $product->categoires()->sync([]);
        $product->delete();
        return $this->infoResponse('product deleted !', 200);
    }

    protected function checkSeller(Seller $seller, Product $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, 'The specified seller is not the actual seller of the product');
        }
    }
}
