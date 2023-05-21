
    /**
     * Delete Product by id
     * @param int $id
     * @return void
     */
    public function deleteProductById(int $id): void
    {
        $this->productDao->deleteProductById($id);
    }
}
