Given two binary arrays of equal length, find the widest range [i, j] (width j − i + 1) on which both arrays have the same sum; return that width, or 0 if no such range exists. For instance, [1,1,0,1] and [0,1,1,0] → 3; [0,1] and [1,1] → 1; [0] and [1] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Same difference, farthest apart

1. `first = {0: −1}`, `d = 0`.
2. For each `i`: `d += a[i] − b[i]`; if `d` seen, `best = max(best, i − first[d])`; else `first[d] = i`.
3. Return `best`.

Constructed checks (verified against brute force on random binary arrays): the three cases above → 3, 1, 0.

Record only the first occurrence; later ones give shorter ranges. Differences lie in `[−n, n]`, so an array of size `2n + 1` can replace the map.

Time: O(n)  
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
