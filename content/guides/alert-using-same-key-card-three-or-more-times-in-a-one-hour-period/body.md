## Window of three

1. Convert `"HH:MM"` to minutes; group by name.
2. Sort each list; check `t[i + 2] − t[i] ≤ 60` for any `i`.
3. Return the names that alert, sorted alphabetically.

Example 1 → `["daniel"]` (10:00, 10:40, 11:00). Example 2 → `["bob"]` (21:00, 21:20, 21:30); alice's 12:00 and 12:01 are not enough.

Times are within one day, so no wrap-around. Do not forget that exactly 60 minutes counts. Do not check consecutive pairs only; three uses are needed.

Time: O(n log n)  
Space: O(n)

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
