<?php

namespace App\Traits;

use App\Enums\SortDirectionsEnum;

trait HandleSortingTrait
{
    public array $sorts = [];
    public array $searches = [];
    public function initializeHandleMultipleSortingAndFiltering()
    {
        if (empty($this->sorts)) {
            $this->sorts = [
                'default' => ['field' => 'created_at', 'direction' => 'asc'],
            ];
        }

        if (empty($this->searches)) {
            $this->searches = [
                'default' => '',
            ];
        }
    }
    public function toggleSort(string $scope, string $field, $event)
    {
        if (!isset($this->sorts[$scope])) {
            $this->sorts[$scope] = ['field' => $field, 'direction' => 'asc'];
        }

        if ($this->sorts[$scope]['field'] === $field) {
            $this->sorts[$scope]['direction'] =
                $this->sorts[$scope]['direction'] === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sorts[$scope]['field'] = $field;
            $this->sorts[$scope]['direction'] = 'asc';
        }

        $this->dispatch($event);
    }
    public function getSortField(string $scope): string
    {
        return $this->sorts[$scope]['field'] ?? 'created_at';
    }
    public function getSortDirection(string $scope): string
    {
        return $this->sorts[$scope]['direction'] ?? 'asc';
    }
    public function getSearch(string $scope): string
    {
        return $this->searches[$scope] ?? '';
    }
}
