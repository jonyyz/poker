<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class StraightTest extends TestCase
{
  public function testStraightAceLow(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::FOUR, CardSuit::CLUBS),
      new Card(CardType::FIVE, CardSuit::HEARTS)
    ]);

    $this->assertTrue($hand->isStraight());
  }

  public function testStraightAceHigh(): void
  {
    $hand = new Hand([
      new Card(CardType::TEN, CardSuit::SPADES),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::DIAMONDS),
      new Card(CardType::KING, CardSuit::CLUBS),
      new Card(CardType::ACE, CardSuit::HEARTS)
    ]);

    $this->assertTrue($hand->isStraight());
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

    $this->assertFalse($hand->isStraight());
  }

  public function testStraightFlush(): void
  {
    $hand = new Hand([
      new Card(CardType::NINE, CardSuit::HEARTS),
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS),
      new Card(CardType::EIGHT, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isStraight());
  }
}
