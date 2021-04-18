<?php


namespace src\Builders\Categories;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiBuilderException;
use src\Models\Images\Category;

class ListResultBuilder
{
    private ?array $response;

    public function __construct(?array $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $result = [];
        if (is_null($this->response)){
            return $result;
        }

        try {
            foreach ($this->response as $category) {
                $result[] = new Category($category);
            }
        } catch (DataTransferObjectError $e) {
            throw new ApiBuilderException('Wrong API response.');
        }

        return $result;
    }
}