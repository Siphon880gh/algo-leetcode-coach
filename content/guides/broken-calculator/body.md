## Reverse the operations

Forward: double, or subtract 1. Backward: halve (only when even), or add 1.

`ops = 0`. While `target > startValue`:

- If `target` is even, `target //= 2`; else `target += 1`.
- `ops += 1`.

Return `ops + (startValue − target)`.

Backward, halving as early as possible is best: any +1 steps done before a halving cost twice as much as doing them after it. Once `target ≤ startValue`, only +1 steps remain (subtractions forward).

Do not search forward with BFS; values can grow up to 10⁹. Do not halve an odd number.

Time: O(log target)  
Space: O(1)

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
