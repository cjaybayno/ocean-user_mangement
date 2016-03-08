<?php

namespace App\Repository;

use App\Entity;
use App\LoanProduct;

class LoanManagement
{

	/**
     * Display Entity in key/value pair 
     *
     * @return array
     */
	public function entities()
	{
		$entityRaw = Entity::orderBy('code')
			->get()
			->keyBy('id');
		
		$entity = collect($entityRaw)
			->map(function($entityRaw) {
				return $entityRaw->code;
			})
			->toArray();
			
		$entity[''] = 'Select Entity';
			
		return $entity;
	}
	
	
	/**
     * Display Loan Products in key/value pair 
     *
     * @return array
     */
	public function loanProducts()
	{
		$loanProductRaw = LoanProduct::orderBy('name')
			->where('entity_id', 1)
			->get()
			->keyBy('id');
		
		$loanProducts = collect($loanProductRaw)
			->map(function($loanProductRaw) {
				return $loanProductRaw->name;
			})
			->toArray();
			
		$loanProducts[''] = 'Select Loan Type';
			
		return $loanProducts;
	}
}