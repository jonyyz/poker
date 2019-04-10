<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class PairTest extends TestCase
{
  public function testPair(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertTrue($hand->isPair());
  }

  public function testFullHouse(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::THREE, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::SPADES)
    ]);

    $this->assertFalse($hand->isPair());
  }

  public function testNotPair(): void
  {
    $hand = new Hand([
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::SEVEN, CardSuit::SPADES),
      new Card(CardType::JACK, CardSuit::SPADES)
    ]);

    $this->assertFalse($hand->isPair());
  }
}
