<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class StraightFlushTest extends TestCase
{
  public function testStraightFlushAceLow(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::HEARTS),
      new Card(CardType::FOUR, CardSuit::HEARTS),
      new Card(CardType::FIVE, CardSuit::HEARTS)
    ]);

    $this->assertTrue($hand->isStraightFlush());
  }

  public function testRoyalFlush(): void
  {
    $hand = new Hand([
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::ACE, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isStraightFlush());
  }

  public function testNotStraightFlushSameSuit(): void
  {
    $hand = new Hand([
      new Card(CardType::FIVE, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::ACE, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isStraightFlush());
  }

  public function testNotStraightFlushDifferentSuits(): void
  {
    $hand = new Hand([
      new Card(CardType::FIVE, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::CLUBS),
      new Card(CardType::ACE, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isStraightFlush());
  }
}
