You are given peaks, where peaks[i] = [x, y] describes a mountain shaped as a right-angled isosceles triangle with its base on the x-axis and its peak at (x, y), so its sides have slopes 1 and −1. A mountain is visible if its peak does not lie within another mountain, border included. Return the number of visible mountains. For instance, [[2,2],[6,3],[5,4]] → 2; [[1,3],[1,3]] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Contained intervals are hidden

1. Map each peak to `(l, r) = (x − y, x + y)` and count duplicates.
2. Sort by `l` ascending, then `r` descending. `maxR = −∞`.
3. For each `(l, r)`: if `r > maxR`, count it when it occurs once, and set `maxR = r`.

Constructed checks (verified against testing every peak against every mountain on 500 random sets): [[2,2],[6,3],[5,4]] → 2, [[1,3],[1,3]] → 0.

`y ≤ b − |x − a|` is the same as `[x − y, x + y] ⊆ [a − b, a + b]`. With that sort order an earlier interval with `r ≥` the current one contains it. Identical mountains hide each other, so both are dropped, but they still raise `maxR`.

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
