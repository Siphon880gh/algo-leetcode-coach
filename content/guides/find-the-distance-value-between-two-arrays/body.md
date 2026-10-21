## Nothing in [x − d, x + d]

1. Sort `arr2`.
2. For each `x`: `i = lower_bound(arr2, x − d)`; count `x` if `i == len` or `arr2[i] > x + d`.

`[4,5,8]`, `[10,9,1,8]`, d = 2 → 2. Second example → 2. Third → 1.

Do not compare every pair when arrays are large; that is O(n · m). Do not use a strict `< d` test; any `y` with `|x − y| ≤ d` disqualifies `x`.

Time: O((n + m) log m)  
Space: O(1) extra

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
