## Recolor as you go

`orig = image[sr][sc]`. If `orig == color`, return `image` unchanged.

DFS from `(sr, sc)`: if the cell is in bounds and equals `orig`, set it to `color` and recurse on its four neighbors.

Recoloring doubles as the visited mark: a recolored cell no longer equals `orig`, so it is never processed again. That is why the early return matters: if `orig == color`, every cell still matches after "recoloring" and the DFS never ends.

Do not include diagonal neighbors. Do not skip the `orig == color` check.

Time: O(m · n)  
Space: O(m · n) recursion in the worst case

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
