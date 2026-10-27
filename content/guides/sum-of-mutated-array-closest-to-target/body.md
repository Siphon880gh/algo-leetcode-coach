## Even share of the rest

1. Sort `arr`; `prefix = 0`.
2. For each `i`: `v = (target − prefix) / (n − i)` (floor). If `v ≤ arr[i]`, compare `v` and `v + 1` by `|prefix + cap · (n − i) − target|` and return the better, the smaller on a tie.
3. Otherwise add `arr[i]` to `prefix`.
4. If none fits, return `max(arr)`.

Binary search on `v` over `[0, max(arr)]` with the mutated sum also works.

`[4,9,3]`, 10 → 3. `[2,3,5]`, 10 → 5. Third example → 11361.

Do not return a cap above `max(arr)`; it changes nothing. Do not break ties upward; the statement asks for the minimum value.

Time: O(n log n)  
Space: O(1) extra

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
