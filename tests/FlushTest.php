<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class FlushTest extends TestCase
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

    $this->assertFalse($hand->isFlush());
  }

  public function testStraightFlushAceHigh(): void
  {
    $hand = new Hand([
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::ACE, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isFlush());
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

    $this->assertFalse($hand->isFlush());
  }

  public function testFlush(): void
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

  public function testNotFlush(): void
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
