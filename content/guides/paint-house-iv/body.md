## Pairs from the outside in

1. dp[(a, b)] = cost[0][a] + cost[n − 1][b] for a ≠ b.
2. For pair i: new (c, d) with c ≠ d, c ≠ a and d ≠ b adds cost[i][c] + cost[n − 1 − i][d].
3. Answer the smallest dp after pair n / 2 − 1.

Examples → 9, 18. Checked against every coloring on 300 random cases.

Ignoring the mirrored rule (plain paint house): example 2 → 17 instead of 18.

Time: O(n · 36)  
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
