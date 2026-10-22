## Range maximum over values

1. Segment tree for maximum over values 0 … max(nums).
2. For each `x`: `v = 1 + query(max(0, x − k), x − 1)`; update position `x` with `v`.
3. Return the largest `v`.

Examples → 5, 4, 1. Checked against the O(n²) DP on 300 random arrays.

Strictly increasing means the previous value is at most x − 1, and the gap limit means at least x − k. The O(n²) DP is about 5 · 10^9 steps for n = 10^5.

Time: O(n log V)  
Space: O(V)

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
