## BFS with an exit check

1. Queue `(start, 0)`; `seen` over 0 … 1000.
2. Pop `(x, d)`; for each `v` and each `y` in `x + v`, `x − v`, `x ^ v`: if `y == goal`, return `d + 1`; if `0 ≤ y ≤ 1000` and unseen, enqueue.
3. Return −1.

Examples → 2, 2, −1.

The goal may lie outside 0 … 1000 (Example 2 reaches −4), so test it before the range check. Each in-range value is expanded once.

Time: O(1001 · n)  
Space: O(1001)

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
