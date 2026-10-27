## Dijkstra, filtered

1. Heap of (time, node), starting (0, 0).
2. Pop; skip if settled or time ≥ disappear[node]; else settle it and push neighbours at time + length.
3. Unsettled nodes → −1.

Examples → [0, −1, 4], [0, 2, 3], [0, −1]. Checked against trying every simple path on 400 random small graphs.

Arriving exactly at the disappear time is too late: allowing it gives example 3 → [0, 1] instead of [0, −1].

Time: O((n + m) log m)  
Space: O(n + m)

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
