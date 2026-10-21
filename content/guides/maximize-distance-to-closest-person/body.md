## Three kinds of empty run

Scan for runs of 0s:

- **Leading run** of length `L` (before the first 1): sit at seat 0, distance `L`.
- **Trailing run** of length `T`: sit at the last seat, distance `T`.
- **Interior run** of length `g` between two 1s: sit in the middle, distance `(g + 1) // 2`.

Return the maximum.

One pass with `prev` = the index of the last 1: at each 1, if `prev == −1`, the leading distance is `i`; otherwise the interior distance is `(i − prev) // 2`. After the loop, the trailing distance is `n − 1 − prev`.

Do not halve the edge runs; at an edge there is nobody on the other side. Do not search every empty seat outward; that is O(n²).

Time: O(n)  
Space: O(1)

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
