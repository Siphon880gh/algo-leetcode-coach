A table lists inventory items, each with an item type and an area. A warehouse has a fixed total area, given in the statement. It is filled first with as many complete copies as fit of the whole set of items of the priority type, and then the space left over with as many complete copies of the whole set of the other type. Report how many items of each type end up stored. The exact type names and the warehouse area are in the official statement. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two steps of integer division

Using the column names the statement gives:

1. Per type: `COUNT(*)` and `SUM(area)`.
2. Priority copies k = floor(capacity / priority area); other copies = floor((capacity − k · priority area) / other area).
3. Report k · priority count and the other copies · other count, named and ordered as asked.

This assumes the two-phase rule as restated above; check the official statement.

Constructed check (run in SQLite, capacity 1,000): priority items of area 100 and 150, other items of area 80, 40 and 30 → priority set 250, 4 copies, 8 items; 0 area left, so 0 other items.

Filling each type independently from the full capacity gives 18 other items in that check; the second set only gets what the first leaves.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
