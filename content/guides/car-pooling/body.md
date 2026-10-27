## Changes, then a sweep

1. `diff = [0] · 1001`. For each trip `[p, from, to]`: `diff[from] += p`, `diff[to] −= p`.
2. `load = 0`. For each location: `load += diff[loc]`; if `load > capacity`, return false.
3. Return true.

Passengers leave at `to` before new ones board there, which subtracting at `to` handles.

For large coordinates, sort the start and end events instead (ends before starts at the same point). Do not simulate passengers one location at a time per trip; that is O(trips · distance).

Time: O(trips + 1001)  
Space: O(1001)

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
