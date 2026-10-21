## Only the target matters

You start at `(0, 0)`. Your best time is `|tx| + |ty|`. A ghost at `(gx, gy)` needs `|gx − tx| + |gy − ty|`.

If any ghost's distance is `≤` yours, it can go straight to the target and wait; you lose. Otherwise, any shortest path for you arrives before any ghost can intercept, because a ghost that could meet you on the way could also reach the target first (triangle inequality).

Return `all(ghost_dist > my_dist)`.

Do not simulate moves or BFS on a grid; coordinates can be 10⁴ and the answer is a formula. Do not use `<`; a tie means the ghost reaches the target with you, which loses.

Time: O(g), for g ghosts  
Space: O(1)

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
