<?php

class Home extends Controller
{
    protected $import;
    protected $product;
    protected $merchant;

    public function __construct()
    {
    }
    /**
     * the home page controller
     */
    public function index()
    {
        $this->view('home/index');
    }

    /**
     * we handle the aploaded file
     * and we show the results
     * @return array
     */
    public function upload()
    {
        $file = $_FILES['file'];
        $upload = new UploadService();
        $file = $upload->upload($file);
        if (!$file) {
            return $upload->errors();
        }
        $models = ['item', 'merchant'];
        $import = new ImportService($file);
        $data = $import->handle($models);
        $this->storeData($data);
        header("Location: show");
    }

    /**
     * we store our imported data en db
     * @param $data
     */
    protected function storeData($data)
    {
        $import = new Raw();
        foreach ($data as $d) {
            $import->store($d);
        }
    }

    /**
     * we show some imported, counts
     */
    public function show()
    {
        $import = new Raw();
        $data['countPerMonth']       = $import->getProductByMonth();
        $data['countPerMerchant']    = $import->getProductByMerchant();
        $this->view('home/results', $data);
    }
}