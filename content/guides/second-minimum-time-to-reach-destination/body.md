## Steps first, minutes later

1. BFS with states `(vertex, steps)`; record at most two distinct step counts per vertex (the first and the strictly larger second).
2. `k` = second count at `n` (it exists: you can always go back and forth once more).
3. Convert: `t = 0`; repeat `k` times: if `(t // change)` is odd (red), wait to `(t // change + 1) · change`; `t += time`.

Examples → 13, 11.

Time is increasing in the step count, so the second smallest time is the second smallest number of steps. A second count is never more than `shortest + 2`, which is why two entries per vertex suffice.

Time: O(n + E)  
Space: O(n + E)

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
