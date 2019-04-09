<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class FullHouseTest extends TestCase
{
  public function testFullHouse(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::THREE, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::SPADES)
    ]);

    $this->assertTrue($hand->isFullHouse());
  }

  public function testNotFullHouse(): void
  {
    $hand = new Hand([
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::CLUBS),
      new Card(CardType::THREE, CardSuit::DIAMONDS),
      new Card(CardType::THREE, CardSuit::SPADES),
      new Card(CardType::TWO, CardSuit::SPADES)
    ]);

    $this->assertFalse($hand->isFullHouse());
  }
}
