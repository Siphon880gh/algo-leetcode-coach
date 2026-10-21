## Shoot at the earliest end

Sort balloons by `x_end`. Keep `last`, the x of the most recent arrow (start at −infinity). For each balloon in order: if `x_start > last`, no arrow hits it yet — shoot a new arrow at its `x_end` and count it. Otherwise the current arrow already bursts it.

Why the end: the balloon that ends first must be hit somewhere in its range. Shooting at its very end hits it and as many later-starting balloons as possible.

Non-overlapping Intervals (435) uses the same sort, but there touching intervals are fine and it counts removals. Merge Intervals (56) merges instead of counting.

Use `>` (not `>=`) when deciding to shoot: ends are inclusive, so `[1,2]` and `[2,3]` share an arrow at 2. Sort with a comparator that does not subtract (`a − b` can overflow with values near ±2^31).

Time: O(n log n)  
Space: O(1) besides the sort

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
