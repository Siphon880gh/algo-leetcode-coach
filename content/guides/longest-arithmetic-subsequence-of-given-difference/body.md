## Extend the previous term

1. `best = {}`.
2. For each `x`: `best[x] = best.get(x − difference, 0) + 1`.
3. Return the largest value in `best`.

`[1,5,7,8,5,3,4,2,1]`, −2 → 4 (7, 5, 3, 1).

Only earlier elements are in the map when `x` is processed, so order is respected.

Do not index by position and scan back for the previous term; that is O(n²) for 10⁵ elements. Do not sort; the subsequence must keep the original order.

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
