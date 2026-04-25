# Lyre Facet

Lyre Facet is a `lyre/lyre` add-on for tagging and organizing records with reusable facets and facet values.

It provides three core models:

- `Facet`: the taxonomy group, such as `Blog Category`, `Task Categories`, or `Subscription Plan Category`
- `FacetValue`: a concrete value inside a facet, such as `Free` or `Main`
- `FacetedEntity`: the polymorphic pivot that links any facetable model to a facet value

## How It Works

### Tagging models

Any model can become facetable by using `Lyre\Facet\Concerns\HasFacet`.

That trait adds:

- `facetedEntities()` morph-many relation to the pivot table
- `facetValues()` has-many-through relation to attached values
- `attachFacetValues($ids)` helper to replace all current facet assignments

This is how Aspire tags exams, assessments, tasks, subscription plans, and articles.

### Hierarchies

Both `Facet` and `FacetValue` support optional parent/child hierarchy through `parent_id`.

The package exposes:

- `parent()`
- `children()`
- `ancestors()`
- `descendants()`
- `roots()` scope

Repositories for `Facet` and `FacetValue` use `HasHierarchy`, which powers:

- `GET /api/facets/hierarchy/{facetId?}`
- `GET /api/facetvalues/hierarchy/{facetValueId?}`

`facetvalues/hierarchy` also accepts a `facet` query parameter so clients can scope root values to a specific facet.

### Resource behavior

- `Facet` uses `slug` as `ID_COLUMN`
- `FacetValue` uses `slug` as `ID_COLUMN`
- both expose lightweight computed fields such as `parent_name` and `facet_name`
- hierarchy endpoints return nested arrays with a `depth` field

## Installation

```bash
composer require lyre/facet
```

Publish assets:

```bash
php artisan vendor:publish --provider="Lyre\Facet\Providers\LyreFacetServiceProvider"
```

If you use Filament, register the plugin:

```php
use Lyre\Facet\Filament\Plugins\LyreFacetFilamentPlugin;

$panel->plugins([
    new LyreFacetFilamentPlugin(),
]);
```

## Example Usage

Add the trait to a model:

```php
use Lyre\Facet\Concerns\HasFacet;

class Article extends Model
{
    use HasFacet;
}
```

Attach facet values:

```php
$article->attachFacetValues([$newsId, $featuredId]);
```

Query tagged models through normal Lyre relation filters:

```http
GET /api/articles?relation=facetValues,featured
```

Or scope dynamic section data in `lyre/content` using the `facet` filter, which resolves all values under a named facet and constrains the target model to those values.

## Aspire Usage Notes

In Aspire, the package is used for:

- blog article categories
- exam categories
- task categories, including the `Free` task flow
- subscription plan categories, including the `Main` plan flow

Good examples to inspect:

- `app/Models/Assessment.php`
- `app/Models/Exam.php`
- `database/seeders/FacetSeeder.php`
- `database/seeders/TaskSeeder.php`
- `app/Filament/Resources/AssessmentResource.php`
- `app/Filament/Resources/ExamResource.php`

## Limits To Keep In Mind

- `attachFacetValues()` is a replace-all helper, not an additive sync helper
- facet-based filtering depends on models exposing the `facetValues` relation
- hierarchy support is implemented only where the repository explicitly uses `HasHierarchy`
