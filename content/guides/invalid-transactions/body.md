## Two rules

1. Parse `name, time, amount, city` for each index.
2. Group indices by name.
3. Index `i` is invalid if `amount > 1000`, or some `j` with the same name has `city ≠ city_i` and `|time_j − time_i| ≤ 60`.
4. Return the original strings of invalid indices.

`["alice,20,800,mtv","alice,50,100,beijing"]` → both invalid.

Do not mark only the later transaction of a close pair; both are invalid. Do not dedupe by string; identical transactions can appear twice and both are returned.

Time: O(n²) worst case  
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
