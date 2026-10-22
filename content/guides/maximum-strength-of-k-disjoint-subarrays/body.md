## Open or closed

1. w_j = (k − j + 1) · (+1 if j odd else −1).
2. For each x: open[j] = max(open[j], closed[j − 1]) + w_j · x; closed[j] = max(closed[j], open[j]).
3. Start closed[0] = 0, everything else −∞; return closed[k].

Examples → 22, 64, −1. Checked against trying every placement on 400 random small arrays.

Values reach about k · 10^9 · n ≈ 3 · 10^13 in size; use 64-bit. The DP has n · k ≤ 10^6 states.

Time: O(n k)  
Space: O(k)

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
