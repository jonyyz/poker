<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class HighCardTest extends TestCase
{
  public function testHighCard(): void
  {
    $hand = new Hand([
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::SEVEN, CardSuit::SPADES),
      new Card(CardType::JACK, CardSuit::SPADES)
    ]);

    $this->assertTrue($hand->isHighCard());
  }

  public function testRoyalFlush(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isHighCard());
  }

  public function testStraightFlushAceLow(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::HEARTS),
      new Card(CardType::FOUR, CardSuit::HEARTS),
      new Card(CardType::FIVE, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isHighCard());
  }  
}
