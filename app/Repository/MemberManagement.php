<?php

namespace App\Repository;

use App\Zipcode;

class MemberManagement
{
	/**
     * list of Province/City.
     *
     * @return array
     */
	public function provinceCity()
	{
		/* === get all province/city === */
		$provinceCityRaw = Zipcode::select('province_city')
			->groupBy('province_city')
			->get()
			->keyBy('province_city');
		
		/* === format province/city to [province/city => province/city] === */
		$provinceCity = collect($provinceCityRaw)
			->map(function($provinceCityRaw) {
				return $provinceCityRaw->province_city;
			})
			->toArray();
			
		/* === add default value === */
		$provinceCity = array_merge(
			[' ' => 'SELECT PROVINCE/CITY'],
			$provinceCity
		);
		
		return $provinceCity;
	}
	
	/**
     * list of Barangay/Town.
     *
     * @return array
     */
	public function brgyTown($provinceCity)
	{
		/* === get brgy/town of province/city === */
		$brgyTownRaw = Zipcode::select('location')
			->where('province_city', $provinceCity)
			->orderBy('location', 'ASC')
			->get()
			->keyBy('location');
		
		/* === format brgy/town to [brgy/town] === */
		$brgyTown = collect($brgyTownRaw)
			->map(function($brgyTownRaw) {
				return $brgyTownRaw->location;
			})
			->toArray();
			
		/* === add default value === */
		$brgyTown = array_merge(
			['SELECT BARANGAY/TOWN'],
			$brgyTown
		);
		
		return $brgyTown;
	}
	
	/**
     * Zipcode of Barangay/Town.
     *
     * @return Object
     */
	public function zipCode($brgyTown)
	{	
		/* === get zipcode of brgy/town === */
		$zipRaw = Zipcode::select('zip')
			->where('location', $brgyTown)
			->first();
		
		return collect($zipRaw)->flatten()->toArray();
	}
}