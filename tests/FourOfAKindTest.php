<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class FourOfAKindTest extends TestCase
{
  public function testFourOfAKind(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::DIAMONDS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertTrue($hand->isFourOfAKind());
  }

  public function testNotFourOfAKind(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::DIAMONDS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertFalse($hand->isFourOfAKind());
  }
}
