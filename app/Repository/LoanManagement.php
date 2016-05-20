<?php
namespace App\Repository;

use DB;
use App\Entity;
use App\Member;
use App\Parameter;
use App\LoanProduct;
use App\LoanApplication;

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
		$loanProductRaw = LoanProduct::select(['id', 'name'])
			->orderBy('name')
			->where('entity_id', session('entity_id'))
			->where('type', 'loan')
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
     * Display balance Product in key/value pair 
     *
     * @return array
     */
	public function balanceProducts()
	{
		$balanceProductRaw = LoanProduct::select(['id', 'name'])
			->orderBy('name')
			->where('entity_id', session('entity_id'))
			->whereIn('type', [
				config('loans.productType.capital'),
				config('loans.productType.savings')
			])
			->get()
			->keyBy('id');
		
		$balanceProducts = collect($balanceProductRaw)
			->map(function($balanceProductRaw) {
				return $balanceProductRaw->name;
			})
			->toArray();
			
		$balanceProducts[''] = 'Select Balances Type';
			
		return $balanceProducts;
	}
	
	/**
     * Get in last name key/value pair
     *
     * @return array
     */
	public function getMemberInLastName($lastName)
	{
		$memberRaw = Member::orderBy('first_name')
			->where('last_name', 'LIKE', $lastName.'%')
			->where('entity_id', session('entity_id'))
			->get()
			->keyBy('id');
		
		$members = collect($memberRaw)
			->map(function($memberRaw) {
				return $memberRaw->first_name.' '.$memberRaw->middle_name.' '.$memberRaw->last_name;
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
	
	/**
     * Get Member list of applications
     *
     * @param int  memberId
     * @return array
     */
	public function getMemberApplications($memberId)
	{
		return $loanApplicationsRaw = LoanApplication::
			join('loan_products', 'loan_applications.loan_product_id', '=' ,'loan_products.id')
			->where('member_id', $memberId)
			->where('fully_paid', false)
			->select([
				'loan_applications.id as product_id', 
				'loan_products.name as product_name',
				'loan_products.principal',
				'loan_products.interest',
			])
			->get()
			->keyBy('product_id')
			->toArray();	
	}
}