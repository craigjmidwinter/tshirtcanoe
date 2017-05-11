<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_code', 'avatar_url','tshirt_count'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function addTshirt(){

		$this->tshirtCount += 1;
		$this->save();
	}

	public function adjustTshirts($newCount){

		$this->tshirtCount = $newCount;
		$this->save();
	}

    public function getTshirtEmojiAttribute() {
        return $this->tshirt_count > 0
            ? str_repeat('👕', $this->tshirt_count)
            : '🙈';
    }

    public function getOtherShitAttribute() {

	    if(!$this->misc_shit) {
		    return null;
	    }
	    $otherShit = [];
	    $lines = explode(PHP_EOL, $this->misc_shit);

	    foreach ($lines as $line) {

		    $shit = explode(',', $line);
			$count = isset($shit[2]) ? trim($shit[2]) : 1;

		    $otherShit[] = [
				'label' => trim($shit[0]),
			    'emoji' => str_repeat(trim($shit[1]), $count),
			    'count' => $count
			];
	    }

	    return $otherShit;
    }
}
