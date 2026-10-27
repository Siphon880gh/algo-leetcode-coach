## Prime masks

1. Count each value. `dp[0] = 2^(count of 1s)`.
2. For each square-free `v` in 2 … 30 with `c` copies: for masks `s` from high to low that contain `mask(v)`, `dp[s] += dp[s − mask(v)] · c`.
3. Return `Σ dp − 1` under 10^9 + 7.

Examples → 3, 1. Checked against testing every subset on 300 random arrays.

At most one copy of each value fits in a square-free product, and the c copies give c choices. Going from high masks to low uses each value once.

Time: O(30 · 2^10 + n)  
Space: O(2^10)

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
