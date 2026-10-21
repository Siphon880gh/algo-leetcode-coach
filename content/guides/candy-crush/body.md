Given a grid of candy types (0 means empty), repeatedly crush every horizontal or vertical run of three or more equal candies at the same time, then let the candies above fall down into the gaps. Stop when no runs remain and return the stable board. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One round

1. **Mark:** for every horizontal triple `(r, c), (r, c+1), (r, c+2)` with the same non-zero value, mark all three; do the same for vertical triples. Marking with a separate boolean grid (or by negating values and comparing absolute values) keeps cells available for both directions.
2. **Crush:** set every marked cell to 0.
3. **Drop:** for each column, use a write pointer from the bottom: copy non-zero values down, then fill the rest above with 0.

Loop while step 1 marked anything.

Runs longer than three are covered because overlapping triples mark every cell. A cell that is part of both a row run and a column run is crushed once.

Do not crush a run as soon as you find it; removing it early can break a crossing run in the other direction. Do not drop candies one cell at a time in a loop; the write pointer does a column in one pass.

Time: O((m · n)²) worst case over all rounds  
Space: O(1) with the negation trick

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
