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
	
	/**
     * Get Advance interest params
     *
     * @param int  loanProductId
     * @return array
     */
	public function getAdvanceInterest($loanProductId)
	{
		/* === get loan product params === */
		$loanProduct   = LoanProduct::select('params')->find($loanProductId);	
		$productParams = json_decode($loanProduct['params'], true);
		
		/* === initialize interest and terms === */
		$responseAdvanceInterest = [
			'interest' => 0,
			'term'	   => 0,
		];
		
		/* === check if has advance interest === */
		if (isset($productParams['advance_interest'])) {
			$advanceInterestParam = $productParams['advance_interest'];
			/* === check if term level is present and in first level === */
			if (isset($advanceInterestParam['term_level']) AND $advanceInterestParam['term_level'] == 1) {
				/* === get interest and term === */
				$responseAdvanceInterest = [
					'interest' => (int) $advanceInterestParam['interest'] / 100,
					'term'	   => (int) $advanceInterestParam['term'],
				];
			}
		}
		
		return $responseAdvanceInterest;
	}
}