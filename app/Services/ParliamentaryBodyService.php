<?php

namespace App\Services;

use App\Models\ParliamentaryBody;
use App\Repositories\ParliamentaryBodyRepository;
use Illuminate\Support\Facades\Storage;

class ParliamentaryBodyService
{
    protected $repo;

    public function __construct(ParliamentaryBodyRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllParliamentaryBodies()
    {
        return $this->repo->getAll();
    }

    public function getParliamentaryBodyBySlug(string $slug)
    {
        return $this->repo->findBySlug($slug);
    }

    public function createParliamentaryBody(array $data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('parliamentary-bodies/images', 'public');
        }

        return $this->repo->create($data);
    }

    public function updateParliamentaryBody(ParliamentaryBody $item, array $data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $data['image']->store('parliamentary-bodies/images', 'public');
        } else {
            unset($data['image']);
        }

        return $this->repo->update($item, $data);
    }

    public function deleteParliamentaryBody(ParliamentaryBody $item)
    {
        return $this->repo->delete($item);
    }
}
