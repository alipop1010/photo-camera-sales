<?php

namespace App\Factory;

use App\Entity\Customer;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

final class CustomerFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Customer::class;
    }

    protected function defaults(): array
    {
        $firstNames = ['Иван', 'Петр', 'Сергей', 'Алексей', 'Дмитрий', 'Андрей', 'Михаил', 'Александр', 'Евгений', 'Владимир'];
        $lastNames = ['Иванов', 'Петров', 'Сидоров', 'Смирнов', 'Кузнецов', 'Попов', 'Васильев', 'Новиков', 'Федоров', 'Морозов'];
        $cities = ['Москва', 'Санкт-Петербург', 'Новосибирск', 'Екатеринбург', 'Казань', 'Нижний Новгород', 'Челябинск', 'Самара', 'Омск', 'Ростов-на-Дону'];
        $streets = ['Ленина', 'Гагарина', 'Пушкина', 'Советская', 'Мира', 'Кирова', 'Комсомольская', 'Садовоя', 'Центральная', 'Молодежная'];
        $emailDomains = ['mail.ru', 'yandex.ru', 'gmail.com', 'rambler.ru'];

        $firstName = $this->faker()->randomElement($firstNames);
        $lastName = $this->faker()->randomElement($lastNames);
        $domain = $this->faker()->randomElement($emailDomains);

        return [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => strtolower($lastName) . '@' . $domain,
            'phoneNumber' => '8' . $this->faker()->numerify('9#########'),
            'address' => 'ул. ' . $this->faker()->randomElement($streets) . ', д. ' . $this->faker()->numberBetween(1, 100),
            'city' => $this->faker()->randomElement($cities),
            'zipCode' => (string) $this->faker()->numberBetween(100000, 199999),
            'country' => 'Россия',
            'registeredAt' => \DateTimeImmutable::createFromMutable($this->faker()->dateTimeBetween('-2 years', 'now')),
        ];
    }
}