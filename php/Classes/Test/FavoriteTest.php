<?php
namespace whatsforlunch\capstoneLunch;
use whatsforlunch\capstoneLunch\Favorite;
require_once("");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the Favorite Class
 *
 * This is a complete PHPUnit test of the Favorite class. It is complete because *ALL* mySQL/PDO enabled methods are
 * tested for both invalid and valid inputs
 *
 * @see \whatsforlunch\capstoneLunch\Favorite
 * @author Jeffrey Gallegos <jgallegos362@cnm.edu>
 */

//TODO check to see if I have everything needed for the FavoriteTest class

class FavoriteTest extends {

	/**
	 * Profile that created the Favorite; this is for foreign key relations
	 * @var Profile Profile
	 */
	protected $profile = null;

	/**
	 * valid profile hash to create the profile object to own the test
	 * @var $VALID_HASH
	 */
	protected $VALID_PROFILE_HASH;

	/**
	 * valid activation token
	 * @var string $profileActivationToken
	 */
	protected $VALID_ACTIVATION_TOKEN = null;

	/**
	 * Restaurant that created the Favorite; this is for foreign key relations
	 * @var string $restaurant
	 */
	protected $restaurant = null;

	/**
	 * create dependent objects before running each test
	 */
	//TODO check the function for the two errors on create and insert profile and restaurant-What do I need here
	public final function setUp() : void {
		//run the default setUp() method first
		parent::setUp();
		$password = "abc123";
		$this->VALID_PROFILE_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION_TOKEN = bin2hex(random_bytes(16));

		//create and insert a Profile to the test Favorite
		$profileId = generateUuidV4();
		$this->profile = new Profile($profileId, $this->VALID_ACTIVATION_TOKEN)
			$this->profile->insert($this->getPDO());

		//create and insert restaurant to test favorite
		$restaurantId = generateUuidV4();
		$this->restaurant = new Restaurant($restaurantId, $profileId)
			$this->restaurant->insert($this->getPDO());
	}

	/**
	 * test inserting a valid favorite and verify that the actual mySQL data matches
	 */
	//TODO check to see if create new favorite and insert into mySQL is correct
	public function testInsertValidFavorite() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favorite");

		//create a new favorite and insert into mySQL
		$favorite = new Favorite($this->profile->getProfileId(), $this->restaurant->getRestaurantId())
			$favorite->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoFavorite = Favorite::getFavoriteByFavoriteProfileId($this->getPDO(), $this->restaurant->getRestaurantId(),
		$this->profile->getProfileId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favorite"));
		$this->assertEquals($pdoFavorite->getFavoriteRestaurntId(), $this->restaurant->getRestaurantId());
		$this->assertEquals($pdoFavorite->getFavoriteProfileId(), $this->profile->getProfileId());
	}







}
