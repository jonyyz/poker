<?php
declare(strict_types=1);

namespace Poker\Model;

use Poker\Model\Card;
use Poker\Model\Contract\CardType;

class Hand implements \IteratorAggregate, \Countable
{
  /**
   * Cards in the hand
   * @var Card[]
   */
  private $cards;

  /**
   * @param Card[] $cards
   */
  function __construct(array $cards)
  {
    $this->cards = $cards;
  }

  /**
   * Implements IteratorAggregate
   * @return Iterator
   */
  public function getIterator(): \Iterator
   {
     return new \ArrayIterator($this->cards);
   }

  /**
   * @return int Card Count
   */
  public function count(): int
  {
    return count($this->cards);
  }

  /**
   * @return bool
   */
  protected function isHandSameSuit(): bool
  {
    $cardSuit = null;
    $cardSuitCounts = array_reduce(
      $this->cards,
      function($cardSuitCounts, $card) {
        $cardSuit = $card->getSuit();
        if(!array_key_exists($cardSuit, $cardSuitCounts)) {
          $cardSuitCounts[$cardSuit] = 1;
        } else {
          $cardSuitCounts[$cardSuit] = $cardSuitCounts[$cardSuit] + 1;
        }

        return $cardSuitCounts;
      },
      []
    );

    return count($cardSuitCounts) === 1;
  }

  /**
   * @return bool
   */
  protected static function isArrayConsecutive(array $values): bool
  {
    for($i = 0; $i < count($values) - 2; ++$i) {
      if($values[$i + 1] - $values[$i] !== 1)
        return false;
    }

    return true;
  }

  /**
   * @return bool
   */
  protected function isHandStraight(): bool
  {
    $cardTypes = array_map(
      function($card) {
        return $card->getType();
      },
      $this->cards
    );

    sort($cardTypes);

    // All cards must be unique types
    if(count($cardTypes) !== count(array_unique($cardTypes))) {
      return false;
    }

    // Determine if the cards are sequential considering ace low
    if(self::isArrayConsecutive($cardTypes))
      return true;

    // Determine if the cards are sequential considering ace high
    $cardTypes = array_map(
      function($cardType) {
        return $cardType === CardType::ACE ? CardType::ACE_HIGH : $cardType;
      },
      $cardTypes
    );

    sort($cardTypes);

    return self::isArrayConsecutive($cardTypes);
  }

  /**
   * @return int[]
   */
  protected function getCardTypeCounts(): array
  {
    $cardType = null;
    return array_reduce(
      $this->cards,
      function($cardTypeCounts, $card) {
        $cardType = $card->getType();
        if(!array_key_exists($cardType, $cardTypeCounts)) {
          $cardTypeCounts[$cardType] = 1;
        } else {
          $cardTypeCounts[$cardType] = $cardTypeCounts[$cardType] + 1;
        }

        return $cardTypeCounts;
      },
      []
    );
  }

  /**
   * @return bool
   */
  public function isHighCard(): bool
  {
    return
      !$this->isRoyalFlush() &&
      !$this->isStraightFlush() &&
      !$this->isFlush() &&
      !$this->isStraight() &&
      !$this->isFullHouse() &&
      !$this->isFourOfAKind() &&
      !$this->isThreeOfAKind() &&
      !$this->isTwoPair() &&
      !$this->isPair();
  }

  /**
   * @return bool
   */
  public function isPair(): bool
  {
    if($this->isFullHouse())
      return false;

    $results = array_filter(
      $this->getCardTypeCounts(),
      function($count) {
        return $count === 2;
      }
    );

    return count($results) === 1;
  }

  /**
   * @return bool
   */
  public function isTwoPair(): bool
  {
    $results = array_filter(
      $this->getCardTypeCounts(),
      function($count) {
        return $count === 2;
      }
    );

    return count($results) === 2;
  }

  /**
   * @return bool
   */
  public function isThreeOfAKind(): bool
  {
    if($this->isFullHouse())
      return false;

    $results = array_filter(
      $this->getCardTypeCounts(),
      function($count) {
        return $count === 3;
      }
    );

    return count($results) === 1;
  }

  /**
   * @return bool
   */
  public function isFourOfAKind(): bool
  {
    $results = array_filter(
      $this->getCardTypeCounts(),
      function($count) {
        return $count === 4;
      }
    );

    return count($results) === 1;
  }

  /**
   * @return bool
   */
  public function isFullHouse(): bool
  {
    $cardTypeCounts = $this->getCardTypeCounts();

    if(count($cardTypeCounts) !== 2)
      return false;

    $keys = array_keys($cardTypeCounts);
    $firstCount = $cardTypeCounts[$keys[0]];

    return in_array($firstCount, [2, 3]);
  }

  /**
   * @return bool
   */
  public function isStraight(): bool
  {
    return !$this->isHandSameSuit() && $this->isHandStraight();
  }

  /**
   * @return bool
   */
  public function isFlush(): bool
  {
    return $this->isHandSameSuit() && !$this->isHandStraight();
  }

  /**
   * @return bool
   */
  public function isStraightFlush(): bool
  {
    if($this->isRoyalFlush())
      return false;

    return $this->isHandSameSuit() && $this->isHandStraight();
  }

  /**
   * @return bool
   */
  public function isRoyalFlush(): bool
  {
    if(!$this->isHandSameSuit() || !$this->isHandStraight())
      return false;

    // Now just need to determine if the lowest card is a 10
    $cardType = null;
    $cardTypes = array_map(
      function($card) {
        $cardType = $card->getType();
        return $cardType === CardType::ACE ? CardType::ACE_HIGH : $cardType;
      },
      $this->cards
    );

    sort($cardTypes);
    return $cardTypes[0] == CardType::TEN;
  }
}
