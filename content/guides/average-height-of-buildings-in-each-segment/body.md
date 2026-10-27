Each building is [start, end, height] and covers the half-open interval [start, end) of a street. Describe the street as a minimal list of non-overlapping segments [left, right, average], where average is the total height of the buildings over that segment divided by their count using integer division, merging touching segments that share an average and leaving out stretches with no building, as the statement specifies. For instance, [[1,4,2],[3,9,4]] → [[1,3,2],[3,4,3],[4,9,4]] and [[1,2,1],[5,6,1]] → [[1,2,1],[5,6,1]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Difference events

1. `ev[start] += (h, 1)`, `ev[end] −= (h, 1)`.
2. Walk positions `x` in sorted order. Before applying `ev[x]`, if `count > 0`, the stretch `[prev, x)` has average `sum // count`: extend the last segment if it ends at `prev` with the same average, else append `[prev, x, avg]`.
3. Apply `ev[x]`; `prev = x`.

Constructed checks (verified against a per-unit brute force on random inputs): the two cases above, and `[[1,3,2],[2,5,3],[2,8,3]]` → `[[1,3,2],[3,8,3]]`.

Merging needs both conditions: the previous segment must end exactly at `prev` (no gap) and share the average. Grouping events at the same position avoids zero-length segments.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
