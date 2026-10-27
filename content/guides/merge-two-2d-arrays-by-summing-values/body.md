## Merge step

1. `i = j = 0`.
2. While both remain: equal ids → append `[id, v1 + v2]` and advance both; else append the smaller id’s pair and advance it.
3. Append whatever is left of either list.

Examples → [[1,6],[2,3],[3,2],[4,6]], [[1,3],[2,4],[3,6],[4,3],[5,5]].

Ids are unique within each list, so an id appears at most twice. An array indexed by id up to 1000 also works.

Time: O(n + m)  
Space: O(1) besides the output

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
