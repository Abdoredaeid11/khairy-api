<?php

namespace App\Services\Fatwa;

use App\Models\Fatwa;
use Illuminate\Database\Eloquent\Builder;

class FatwaService
{
    /**
     * جلب الفتاوى مع الفلترة والترقيم
     */
    public function getPublishedFatwas(array $filters = [], int $perPage = 10)
    {
        $query = Fatwa::query()->where('is_published', true);

        return $this->applyFilters($query, $filters)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * جلب كافة الفتاوى (للأدمن) مع الفلترة
     */
    public function getAllFatwas(array $filters = [], int $perPage = 10)
    {
        $query = Fatwa::query();

        return $this->applyFilters($query, $filters)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * تطبيق الفلاتر المشتركة
     */
    protected function applyFilters(Builder $query, array $filters)
    {
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('content', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('is_published', $filters['status']);
        }

        return $query;
    }

    public function create(array $data)
    {
        return Fatwa::create($data);
    }

    public function update(array $data, Fatwa $fatwa)
    {
        $fatwa->update($data);
        return $fatwa;
    }

    public function delete(Fatwa $fatwa)
    {
        return $fatwa->delete();
    }
}
