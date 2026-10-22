## One pass

1. `prev = 0`, `best = (0, n)`.
2. For each `[id, t]`: `d = t − prev`; if `d > best.d` or (`d = best.d` and `id < best.id`), `best = (d, id)`; `prev = t`.
3. Return `best.id`.

Examples → 1, 3, 0.

The first task starts at time 0, so its duration is its leave time. Ties go to the smaller id even when the larger id comes first, as in Example 3, where both tasks last 10.

Time: O(len(logs))  
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
