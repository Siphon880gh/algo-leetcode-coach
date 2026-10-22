## Digit DP

1. `f(i, s, tight)`: numbers formed from position i with digit sum s so far; prune when `s > max_sum`; at the end, count `s ≥ min_sum`.
2. `count(num)` = `f(0, 0, true)` over num’s digits.
3. Return `count(num2) − count(num1) + good(num1)` mod 10^9 + 7.

Examples → 11, 5. Checked against direct counting on 200 random small ranges.

Subtracting count(num1) removes num1 too, so add it back: example 1 without that → 10 instead of 11. Leading zeros do not change a digit sum, so shorter numbers need no special case.

Time: O(L · max_sum · 10) for L ≤ 23 digits  
Space: O(L · max_sum)

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
