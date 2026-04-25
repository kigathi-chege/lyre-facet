# `lyre/facet` Agent Guide

## Package Purpose
`lyre/facet` provides reusable taxonomy tagging via facets, facet values, and polymorphic faceted entity links, including hierarchy endpoints.

## What Belongs In This Package
- Facet taxonomy models (`Facet`, `FacetValue`, `FacetedEntity`).
- Facet hierarchy API behavior and repository logic.
- `HasFacet` concern and model tagging helpers.

## What Does Not Belong Here
- Content page structure logic (`lyre/content`).
- Media/file handling (`lyre/file`).

## Public API / Stable Contracts
- `api/facets`, `api/facetvalues`, and hierarchy endpoints.
- `HasFacet` relation names/behavior (`facetValues`, `facetedEntities`, `attachFacetValues`).

## Internal Areas That May Change
- Internal hierarchy query implementation preserving endpoint contract.

## Usage Rules
- Use this package for category/tag style classification across domains.
- Keep relation naming stable to avoid breaking query filters and dynamic data loaders.

## Extension Rules
- Add taxonomy-specific capabilities here, not in domain packages.
- Preserve existing hierarchy response shape if extending hierarchy endpoints.
- Keep `attachFacetValues` semantics explicit (replace-all behavior).

## Testing Requirements
- Validate hierarchy endpoints for root and child queries.
- Validate relation filters against faceted models.

## Docs To Update When This Package Changes
- Root [AGENTS.md](/Users/chegekigathi/Projects/packages/lyre-packages/AGENTS.md)
- [docs/package-responsibilities.md](/Users/chegekigathi/Projects/packages/lyre-packages/docs/package-responsibilities.md)
- `packages/facet/README.md`
