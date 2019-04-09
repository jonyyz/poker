<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class RoyalFlushTest extends TestCase
{
  public function testRoyalFlush(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::KING, CardSuit::HEARTS),
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS)
    ]);

    $this->assertTrue($hand->isRoyalFlush());
  }

  public function testNotRoyalFlushSameSuit(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::HEARTS),
      new Card(CardType::THREE, CardSuit::HEARTS),
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isRoyalFlush());
  }

  public function testNotRoyalFlushDifferentSuits(): void
  {
    $hand = new Hand([
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::QUEEN, CardSuit::DIAMONDS),
      new Card(CardType::THREE, CardSuit::HEARTS),
      new Card(CardType::TEN, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::HEARTS)
    ]);

    $this->assertFalse($hand->isRoyalFlush());
  }
}
