## All pairs, then count

1. `d[i][i] = 0`, `d[u][v] = d[v][u] = w`, others ∞.
2. For `k`, `i`, `j`: `d[i][j] = min(d[i][j], d[i][k] + d[k][j])`.
3. For each `i`, `cnt = #{j ≠ i : d[i][j] ≤ threshold}`; keep the smallest `cnt`, using `≤` while scanning upward so a later index wins ties.

First example, threshold 4 → 3. Second, threshold 2 → 0.

Do not put `k` in the inner loop; it must be outermost. Do not break ties toward the smaller index; the larger one wins.

Time: O(n³)  
Space: O(n²)

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
