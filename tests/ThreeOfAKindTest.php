<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class ThreeOfAKindTest extends TestCase
{
  public function testThreeOfAKind(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertTrue($hand->isThreeOfAKind());
  }

  public function testFullHouse(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::NINE, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertFalse($hand->isThreeOfAKind());
  }

  public function testFourOfAKind(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertFalse($hand->isThreeOfAKind());
  }

  public function testNotThreeOfAKind(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::SPADES),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::ACE, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertFalse($hand->isThreeOfAKind());
  }
}
