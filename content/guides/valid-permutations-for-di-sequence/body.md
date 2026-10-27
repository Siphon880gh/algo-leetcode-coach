## Track ranks, not values

After placing `i + 1` numbers, relabel them `0 … i` by rank. `dp[i][j]` = number of valid arrangements whose last element has rank `j`.

Start: `dp[0][0] = 1`.

For step `i` (character `s[i − 1]`), new last rank `j` in `0 … i`:

- `'I'`: the previous last rank `k` must be below `j`: `dp[i][j] = Σ_{k < j} dp[i − 1][k]`.
- `'D'`: the previous last rank must be at or above `j` (old ranks ≥ j shift up by one): `dp[i][j] = Σ_{k ≥ j} dp[i − 1][k]`.

Prefix sums over `dp[i − 1]` make each step O(n). The answer is `Σ_j dp[n][j]` mod 10⁹ + 7.

Do not enumerate permutations; n can be 200. Do not use `k ≤ j` for `'I'`; ranks are distinct, and inserting rank `j` pushes old ranks ≥ `j` up.

Time: O(n²)  
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
