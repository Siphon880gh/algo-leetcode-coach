## Pop the group

1. `groups[value] = [indices]`.
2. BFS from 0: neighbours are `i − 1`, `i + 1`, and `groups.pop(arr[i], [])`.
3. Return the distance when reaching `n − 1`.

`[100,-23,-23,404,100,23,23,23,3,404]` → 3. `[7]` → 0. `[7,6,9,6,9,6,9,7]` → 1.

Do not keep the group after using it; long runs of equal values make BFS quadratic. Do not forget the backward move `i − 1`; it can be part of the shortest path.

Time: O(n)  
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
