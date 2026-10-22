## Contiguous runs per factory

1. Sort robots and factories by position. `dp[i]` = least distance to fix the first `i` robots; `dp[0] = 0`, the rest ∞.
2. For each factory `(p, lim)`: for each `i`, add the robots `i − 1, i − 2, …` one at a time, up to `lim`, accumulating `|robot − p|`, and update `new[i] = min(new[i], dp[i − t] + cost)`.
3. Return `dp[n]` after all factories.

Examples → 4, 2. Checked against trying every assignment on 200 random small cases.

Crossing assignments can always be swapped without raising the total, which is why runs stay contiguous. Distances add up to about 100 · 2 · 10^9, so use 64-bit.

Time: O(m · n · limit), at most 100³  
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
