## Monotone feasibility

1. `ok(d)`: water = first `d` cells; BFS from every land cell in row 1; reachable row `row` → true.
2. Largest `d` with `ok(d)` (upper mid).

Example 1 → 2. Example 2 → 1. Example 3 → 3.

Reverse union-find: start fully flooded, add land back from the last day, union with land neighbours and virtual top/bottom nodes; the first time top and bottom connect, the answer is that day − 1. That is near O(r · c).

Time: O(r · c · log(r · c))  
Space: O(r · c)

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
