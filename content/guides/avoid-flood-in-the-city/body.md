## Earliest usable dry day

1. `full[lake] = day` it last filled; `dry` = sorted list of zero days.
2. On rain at lake `L` already full: find the first dry day `> full[L]` (binary search); if none, return `[]`; assign it to `L` and remove it.
3. Rain days output −1; leftover dry days output any lake (e.g. 1).

`[1,2,3,4]` → `[-1,-1,-1,-1]`. `[1,2,0,0,2,1]` → `[-1,-1,2,1,-1,-1]`. `[1,2,0,1,2]` → `[]`.

Do not dry greedily on the dry day itself; you do not yet know which lake will flood next. Use an ordered set or a tree for O(log n) removals.

Time: O(n log n)  
Space: O(n)

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
