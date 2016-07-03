<?php

class ImportService
{
    protected $lines;
    protected $columns;
    protected $rows = [];
    protected $data;

    public function __construct($file)
    {
        $this->lines = file('../'.$file);
    }

    /**
     * The method get data that return the imported data organized by the model name
     * @param array $models
     * @return array
     */
    public function handle($models)
    {
        $this->getColumns();
        $this->parse();
        $this->data = $this->normalize($models);
        return $this->data;
    }

    /**
     * we get the first name assuming that the first line well present always the difinition of columns
     */
    protected function getColumns()
    {
        $this->columns = explode("\t", $this->lines['0']);
        unset($this->lines[0]);
    }

    /**
     * we parse the data from the file to a an array andd we combine with the column array
     */
    protected function parse()
    {
        foreach ($this->lines as $line) {
            $row = explode("\t", $line);
            $this->rows[] = array_combine($this->columns, $row);
        }
    }

    /**
     * normalize the data we get from file, we search on data the gived models and we build a new multi array with specific data for spicific model
     * @param array $models
     * @return array array of models with data of each
     */
    protected function normalize(array $models)
    {
        $data = [];
        $r=0;
        foreach ($this->rows as $field) {
            foreach ($field as $name => $value) {
                $key = $this->normalizeForModel($name);
                $key = str_replace(' ', '', $key);
                $data[$r][$key] = $value;
            }
            $r++;
        }

        return $data;
    }

    /**
     *
     * @param string $name
     * @return mixed
     */
    private function normalizeForModel($name)
    {
        if (strpos($name, 'item') !== false) {
            $key =  str_replace('item ', '', $name);
        } else {
            $key =  str_replace('merchant ', '', $name);
        }

        return $key;
    }
}