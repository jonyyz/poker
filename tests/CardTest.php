<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Poker\Model\Card;
use Poker\Model\Contract\CardSuit;
use Poker\Model\Contract\CardType;

final class CardTest extends TestCase
{
  public function testCard(): void
  {
    $card = new Card(CardType::THREE, CardSuit::HEARTS);

    $this->assertEquals(CardType::THREE, $card->getType());
    $this->assertEquals(CardSuit::HEARTS, $card->getSuit());
  }
}
