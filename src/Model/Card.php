<?php
declare(strict_types=1);

namespace Poker\Model;

class Card
{
  /**
   * Type of Card (TWO, THREE, etc.)
   * @var int
   */
  private $type;

  /**
   * Suit of card (Hearts, Diamonds, etc)
   * @var int
   */
  private $suit;

  /**
   * @param int $type
   * @param int $suit
   */
  function __construct($type, $suit)
  {
    $this->type = $type;
    $this->suit = $suit;
  }

  /**
   * @return int
   */
  function getType(): int
  {
    return $this->type;
  }

  /**
   * @return int
   */
  function getSuit(): int
  {
    return $this->suit;
  }
}
