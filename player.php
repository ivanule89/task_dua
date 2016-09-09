<?php

class Player
{
	private $name, $mana, $blood ;

	function __construct($name) {
		$this->name = $name;
		$this->mana = 40;
		$this->blood = 100;
	}

	function get_name()
	{
		return $this->name;
	}

	function get_blood()
	{
		return $this->blood;
	}

	function get_mana()
	{
		return $this->mana;
	}

	function defend()
	{
		$this->blood -= 25;
	}

	function attack()
	{
		$this->mana -= 10;
	}
}

class Menu {
	
	private $players =[];

	function main() {
		$start = true;
		while ($start) {
			print_r("#=====================================#\n");
			print_r("#---- Welcome to the Battle Arena ----#\n");
			print_r("#-------------------------------------#\n");
			print_r("#------------ Description ------------#\n");
			print_r("# 1. type 'new' to create a character #\n");
			print_r("# 2. type 'start' to begin the fight  #\n");
			print_r("# ------------------------------------#\n");
			print_r("#=====================================#\n");
			print_r("Enter your chooise : ");
			$chooise = fgets(STDIN);
			
			if (trim($chooise) === "new") {
				if (count($this->players) >=3) {
					echo "Ups Player is Full, continue to battle...\n";
					$this->battle();
				} else {
					$this->add_player();
					$this->current_player();					
				}
			} elseif (trim($chooise) === "start") {
				$this->battle();
			} else {
				echo "Wrong Input!!!\n";
				// $start = false;
			}	
		}
	}
	
	public function add_player()
	{
		print_r("#=====================================#\n");
		print_r("#---- Welcome to the Battle Arena ----#\n");
		print_r("#=====================================#\n");
		print_r("Insert new player : ");
		$nama_player = fgets(STDIN);
		// print_r($nama_player);
		// die();
		$this->players[trim($nama_player)] = new Player(trim($nama_player));
	}

	function battle()
	{
		$game_start = true;
		while ($game_start) {
			print_r("#=====================================#\n");
			print_r("#---- Welcome to the Battle Arena ----#\n");
			print_r("#=====================================#\n");
			
			print_r("Attacker : ");
			$attacker = fgets(STDIN);
			
			print_r("Defender : ");
			$defender = fgets(STDIN);

			if (!$this->players[trim($attacker)] || !$this->players[trim($defender)]) {
				print_r("Maaf player tidak terdaftar!!!\n");
			} elseif ($this->players[trim($attacker)] == $this->players[trim($defender)]) {
				print_r("Maaf tidak dapat menyerang diri sendiri!!!\n");
			} else {
				$this->players[trim($attacker)]->attack();
				$this->players[trim($defender)]->defend();

				print_r("Description Battle:\n");
				print_r(trim($attacker). " : manna = ".$this->players[trim($attacker)]->get_mana().", blood = ".$this->players[trim($attacker)]->get_blood()."\n");
				print_r(trim($defender). " : manna = ".$this->players[trim($defender)]->get_mana().", blood = ".$this->players[trim($defender)]->get_blood()."\n");
				if ($this->players[trim($attacker)]->get_blood() == 0 || $this->players[trim($defender)]->get_blood() == 0) {
					print_r("Game Over!!!!");
					$game_start = false;
					// unset($this->players);
					die();
				}
			}
		}
	}

	function current_player()
	{
		print_r("#=====================================#\n");
		print_r("#-------------- Players --------------#\n");
		print_r("#=====================================#\n");

		foreach ($this->players as $player) {
			// print_r($player);
			print_r("Player ".$player->get_name()."\n");
		}

		print_r("#Minimal 2 player dan Maksimal 3 player#\n");
		print_r("#=====================================#\n");
	}
}

$game = new Menu;
$game->main();