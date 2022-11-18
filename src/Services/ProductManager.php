<?php


namespace App\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class ProductManager
{
    /**
     * Inject to get parameter from YML file
     */
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Get all Product from sheet
     */
    public function getProducts(): array
    {
        $products = [];

        /** Getting File path */
        $productFile = $this->container->getParameter('product_sheet');

        /** Create Sheet reader object and load sheet*/
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheet = $reader->load($productFile);

        /** Count for multiple sheet and get data from multiple sheet*/
        $sheetCount = $spreadSheet->getSheetCount();
        for ($i = 0; $i < $sheetCount; $i++)
        {
            /** Load one by one sheet */
            $sheet = $spreadSheet->getSheet($i);
            $sheetData = $sheet->toArray(null, true, true, true);

            if (!empty($sheetData)) {
                /** Preparing data array */
                foreach ($sheetData as $k => $data) {
                    /** Skip first row because it contain titles */
                    if ($k != 1) {
                        if(isset($data['A']) && !empty($data['A'])) {
                            $products[$k]['id'] = $k;
                            $products[$k]['model'] = (isset($data['A'])) ? $data['A'] : '';
                            $products[$k]['ram'] = (isset($data['B'])) ? $data['B'] : '';
                            $products[$k]['hdd'] = (isset($data['C'])) ? $data['C'] : '';
                            $products[$k]['location'] = (isset($data['D'])) ? $data['D'] : '';
                            $products[$k]['price'] = (isset($data['E'])) ? $data['E'] : '';
                        }
                    }
                }
            }

        }
        /** Filter and remove if empty data is available and reset array index  */
        return array_values($products);
    }
}