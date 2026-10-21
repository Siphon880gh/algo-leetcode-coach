## Per-second collision check

1. For each piece: moves = staying put, plus every (direction, distance) that stays on the board for its allowed directions.
2. For each combination: for `t = 1 … 7`, a piece's square is `start + dir · min(t, dist)`; reject if two pieces share a square at the same `t`.
3. Count the surviving combinations.

Examples → 15, 22, 12. Constructed check: two rooks at (1, 1) and (8, 8) → 223, computed by the same simulation.

A piece that has stopped still occupies its square, which is what `min(t, dist)` models. Pieces may pass through each other between seconds, since only shared squares at the same second are collisions. At most about 28 moves per queen gives roughly 28^4 ≈ 6 · 10^5 combinations, each checked in 7 · 4² steps.

Time: O(M^p · 8 · p²) with M moves per piece, p ≤ 4  
Space: O(p)

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
