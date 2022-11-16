<?php

namespace Amirsadjad\SimpleListFormatter\Classes;

use Amirsadjad\SimpleListFormatter\Models\SimpleListPresets;

class SimpleListFormatter
{
    private $data;
    private $preset;
    private $dataType;
    private $pageNumber = 1;
    private $query = null;

    /**
     * This acts as the constructor and should be called first
     * @param $data
     * @param $preset
     * @return $this
     */
    public function Of($data, $preset)
    {
        $this->data = $data;
        $this->setPreset($preset);
        $this->setDataType();
        $this->convertDataToCollection();
        $this->filterSpecifiedColumns();
        return $this;
    }

    /**
     * @param $query
     * @return $this
     */
    public function search($query)
    {
        $this->query = $query = str($query)->lower();

        $this->data = $this->data->filter(function ($datum) use ($query) {
            return collect($datum)->search(function ($item, $column) use ($query) {
                return $this->preset['columns'][$column]['is_searchable'] && str($item)->lower()->contains($query);
            });
        });

        return $this;
    }

    /**
     * @param $column
     * @param $desc
     * @return $this
     */
    public function sortBy($column, $desc)
    {
        if ( isset($this->preset['columns'][$column]) && $this->preset['columns'][$column]['is_sortable'] ) {
            $this->data = $desc ? $this->data->sortByDesc($column) : $this->data->sortBy($column);
        }

        return $this;
    }

    /**
     * @param $pageNumber
     * @return void
     */
    public function pageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * Generates the final result based on all the needs.
     * This should be called at the end of every use of this class
     * @return array
     */
    public function generate()
    {
        return [
            'query' => $this->query,
            'preset' => $this->preset,
            'columns' => array_keys($this->preset['columns']),
            'page_number' => $this->pageNumber,
            'page_count' => (int) ceil (count($this->data) / $this->preset['page_size'] ),
            'data' => $this->data->forPage($this->pageNumber, $this->preset['page_size'])
        ];
    }

    /**
     * @param $preset
     * @return void
     */
    private function setPreset($preset)
    {
        $this->preset = gettype($preset) === 'array' ? $preset : SimpleListPresets::find($preset)->data;
    }

    /**
     * @return void
     */
    private function setDataType()
    {
        $this->dataType = gettype($this->data) === 'array' ? 'array' : (
        $this->data instanceof \Illuminate\Database\Eloquent\Collection ? 'eloquent' : (
        $this->data instanceof \Illuminate\Support\Collection ? 'collection' : 'unauthorized'
        ));
    }

    /**
     * @return void
     */
    private function convertDataToCollection()
    {
        if (in_array($this->dataType, ['collection', 'eloquent'])) $this->data = collect($this->data->toArray());
        elseif ($this->dataType === 'array') $this->data = collect(collect($this->data)->toArray());
        else $this->data = collect([]);
    }

    /**
     * @return void
     */
    private function filterSpecifiedColumns() {
        $this->data = $this->data->map(function($datum) {
            return collect($datum)->only(array_keys($this->preset['columns']))->toArray();
        });
    }
}
