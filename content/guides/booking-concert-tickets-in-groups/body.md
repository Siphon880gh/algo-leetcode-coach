## Max for gather, sum for scatter

1. Leaf `r`: `free = m − used[r]`; nodes keep `max` and `sum`.
2. `gather(k, maxRow)`: descend to the leftmost row with `free ≥ k`; if it is `> maxRow` or none, return []; else return `[row, used]` and add `k` to `used`.
3. `scatter(k, maxRow)`: if `sum(0 … maxRow) < k`, return false; else from the first non-full row (a moving pointer) fill rows until `k` is placed.

Example → [0,0], [], true, false.

The pointer only moves forward because full rows stay full, so scatter is amortised O(log n) per row emptied. Totals reach 5 · 10^4 · 10^9, so sums need 64-bit.

Time: O(log n) per call, amortised  
Space: O(n)

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
