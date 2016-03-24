<?php

namespace App\Repository;

use App\Entity;
use App\LoanProduct;
use App\Member;

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
			->where('entity_id', session('entity_id'))
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
	
	/**
     * Display Loan Products in key/value pair 
     *
     * @return array
     */
	public function getMemberInLastName($lastName)
	{
		$memberRaw = Member::orderBy('first_name')
			->where('last_name', 'LIKE', $lastName.'%')
			->get()
			->keyBy('id');
		
		$members = collect($memberRaw)
			->map(function($memberRaw) {
				return $memberRaw->first_name.' '.$memberRaw->middle_name.'. '.$memberRaw->last_name;
			})
			->toArray();
		
		return $members;
	}
}