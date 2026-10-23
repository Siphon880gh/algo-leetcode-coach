## Digit DP

1. count(x): dfs(i, d, tight) adds +digit at even indices and −digit at odd ones; count d = 0 at the end; subtract 1 for the number 0.
2. Return count(high) − count(low − 1).

Examples → 9, 1, 0. Checked against a direct check for 300 random ranges up to 30,000.

Storing only |d| in the state: example 1 → 0 instead of 9.

Time: O(D · 9D · 10) with D ≤ 16 digits  
Space: O(D · 9D)

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
