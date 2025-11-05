<?php

namespace App\Factory;

use App\Entity\Purchase;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

final class PurchaseFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Purchase::class;
    }

    protected function defaults(): array
    {
        $statuses = ['завершен', 'доставляется', 'обрабатывается', 'отменен'];
        $paymentMethods = ['карта', 'наличные', 'онлайн', 'перевод'];
        $notes = [
            'Срочная доставка',
            'Подарочная упаковка',
            'Клиент постоянный',
            'Первая покупка',
            'Со скидкой 10%',
            null
        ];

        $camera = CameraFactory::random();
        $quantity = $this->faker()->numberBetween(1, 3);
        $cameraPrice = $camera->getPrice();

        return [
            'customer' => CustomerFactory::random(),
            'camera' => $camera,
            'quantity' => $quantity,
            'totalPrice' => $cameraPrice * $quantity,
            'status' => $this->faker()->randomElement($statuses),
            'purchaseDate' => \DateTimeImmutable::createFromMutable($this->faker()->dateTimeBetween('-1 year', 'now')),
            'shippingAddress' => $this->faker()->address(),
            'paymentMethod' => $this->faker()->randomElement($paymentMethods),
            'notes' => $this->faker()->randomElement($notes),
        ];
    }
}