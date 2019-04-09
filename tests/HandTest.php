<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Hand;
use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class HandTest extends TestCase
{
  public function testHand(): void
  {
    $hand = new Hand([
      new Card(CardType::TWO, CardSuit::HEARTS),
      new Card(CardType::TWO, CardSuit::SPADES),
      new Card(CardType::ACE, CardSuit::HEARTS),
      new Card(CardType::JACK, CardSuit::CLUBS),
      new Card(CardType::NINE, CardSuit::DIAMONDS)
    ]);

    $this->assertEquals(5, count($hand));
  }
}
