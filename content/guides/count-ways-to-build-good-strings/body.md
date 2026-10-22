## Count by length

1. `dp[0] = 1`.
2. For `L = 1 … high`: `dp[L] = dp[L − zero] + dp[L − one]`, skipping a term whose index is negative, mod 10^9 + 7.
3. Return `Σ dp[low … high]` mod 10^9 + 7.

Examples → 8, 5.

Different block sequences give different strings, since a string can be cut back into its last block uniquely. When zero = one, both terms are added, as in Example 1, because the blocks hold different characters.

Time: O(high)  
Space: O(high)

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
