<?php

namespace whatsforlunch\capstonelunch;

require_once (dirname(__DIR__) .  "/classes/autoload.php");

use http\Exception\BadQueryStringException;
use Ramsey\Uuid\Uuid;

/**
 * Favorite class for the users of the whatsforlunch application
 * This Favorite class describes the attributes that make up the user's favorite list.
 * @author Jeffrey Gallegos <jgallegos362@cnm.edu>
 */

class Favorite {
	use ValidateUuid;

	/**
	 * foreign key for the profile id
	 * @var
	 */
	private $favoriteProfileId;
	/**
	 * foreign key for the restaurant id
	 * @var
	 */
	private $favoriteRestaurantId;

	/**
	 * Constructor for Favorites
	 *
	 * @param Uuid| string $newFavoriteProfileId value for the favorite profile id
	 * @param Uuid| string $newFavoriteRestaurantId value for the favorite restaurant id
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if the data values entered are too large
	 * @throws \TypeError if the data type violate hints
	 * @throws \Exception
	 */
	public function __construct(string $newFavoriteProfileId, string $newFavoriteRestaurantId) {
		try {
			$this->setFavoriteProfileId($newFavoriteProfileId);
			$this->setFavoriteRestaurantId($newFavoriteRestaurantId);
		} //Determine the exception that was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
}

/**
 * accessor method for the favoriteProfileId
 * @return Uuid value of the favorite profile id
 */
	public function getFavoriteProfileId() : Uuid {
		return($this->favoriteProfileId);
	}

	/**
	 * Mutator method for the favoriteProfileId
	 *
	 * @param Uuid| string $newFavoriteProfileId new value of favorite profile id
	 * @throws \RangeException if the $newFavoriteProfileId is not positive
	 * @throws \TypeError if $newFavoriteProfileId is not a Uuid or string
	 */
	public function setFavoriteProfileId($newFavoriteProfileId) : void {
		try {
			$uuid = self::validateUuid($newFavoriteProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the new favorite profile id
		$this->favoriteProfileId = $uuid;
	}

	/**
	 * accessor method for the favoriteRestaurantId
	 * @return Uuid value of the favorite Restaurant id
	 */
	public function getFavoriteRestaurantId() : Uuid {
		return($this->favoriteRestaurantId);
	}

	/**
	 * Mutator method for the favoriteRestaurantId
	 *
	 * @param Uuid| string $newFavoriteRestaurantId new value of favorite restaurant id
	 * @throws \RangeException if the $newFavoriteRestaurantId is not positive
	 * @throws \TypeError if $newRestaurantId is not a uuid or a string
	 */
	public function setFavoriteRestaurantId($newFavoriteRestaurantId) : void {
		try {
			$uuid = self::validateUuid($newFavoriteRestaurantId);
		} catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the favoriteRestaurantId
		$this->favoriteRestaurantId = $uuid;
	}


}