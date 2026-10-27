You are given paint, where paint[i] = [start_i, end_i] means on day i you paint the area between start_i and end_i (half-open: end excluded). Painting an already painted unit adds nothing. Return worklog, where worklog[i] is the amount of new area painted on day i. For instance, [[1,4],[4,7],[5,8]] → [3,3,1]; [[1,4],[5,8],[4,7]] → [3,3,1]; [[1,5],[2,4]] → [4,0]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Every unit is painted once

1. `find(x)` returns the first unpainted unit ≥ x, following `next` with path compression.
2. Day `[a, b)`: `x = find(a)`; while `x < b`: count it, `next[x] = x + 1`, `x = find(x + 1)`.

Constructed checks (verified against a set of painted units on random inputs): the three cases above → `[3,3,1]`, `[3,3,1]`, `[4,0]`.

Without the jumps, re-scanning painted stretches can cost O(n · range). A sorted set of unpainted intervals or a segment tree also works.

Time: O((n + range) · α)  
Space: O(range)

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
