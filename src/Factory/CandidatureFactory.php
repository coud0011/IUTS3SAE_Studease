<?php

namespace App\Factory;

use App\Entity\Candidature;
use App\Repository\CandidatureRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Candidature>
 *
 * @method        Candidature|Proxy                     create(array|callable $attributes = [])
 * @method static Candidature|Proxy                     createOne(array $attributes = [])
 * @method static Candidature|Proxy                     find(object|array|mixed $criteria)
 * @method static Candidature|Proxy                     findOrCreate(array $attributes)
 * @method static Candidature|Proxy                     first(string $sortedField = 'id')
 * @method static Candidature|Proxy                     last(string $sortedField = 'id')
 * @method static Candidature|Proxy                     random(array $attributes = [])
 * @method static Candidature|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CandidatureRepository|RepositoryProxy repository()
 * @method static Candidature[]|Proxy[]                 all()
 * @method static Candidature[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Candidature[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Candidature[]|Proxy[]                 findBy(array $attributes)
 * @method static Candidature[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Candidature[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CandidatureFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'candidat' => UserFactory::random(['tpUser' => 1]),
            'insertion_professionnelle' => InsertionProfessionnelleFactory::random(),
            'motivation' => self::faker()->text(300),
            'date' => self::faker()->dateTimeBetween('-1 week', 'now'),
            'statut' => 0,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Candidature $candidature): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Candidature::class;
    }
}
