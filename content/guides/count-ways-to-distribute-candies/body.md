Count the ways to put n distinct candies into k bags so that every bag is non-empty, where only which candies share a bag matters (bags are not labelled). Return the count modulo 1e9+7. For instance, n = 3, k = 2 → 3 and n = 4, k = 2 → 7. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Place candy i

1. `dp[0][0] = 1`.
2. `dp[i][j] = dp[i − 1][j − 1] + j · dp[i − 1][j]` (mod 1e9+7).
3. Return `dp[n][k]`.

Constructed check: (3, 2) → 3. (4, 2) → 7. (20, 5) → 749206090500 before the modulo.

Do not multiply by k! (bags are unlabelled). A rolling 1-D array (j descending) cuts memory.

Time: O(n · k)  
Space: O(n · k), or O(k)

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
