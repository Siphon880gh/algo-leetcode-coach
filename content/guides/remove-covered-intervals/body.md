## Sweep the ends

1. Sort by `(start, −end)`.
2. `maxEnd = −∞`, `count = 0`.
3. For each `[a, b]`: if `b > maxEnd`, `count++` and `maxEnd = b`.

`[[1,4],[3,6],[2,8]]` → 2. `[[1,4],[2,3]]` → 1.

Do not sort by start alone; with equal starts the shorter interval must come second so it is seen as covered. Do not compare only with the previous interval; use the running max end.

Time: O(n log n)  
Space: O(1) extra

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
