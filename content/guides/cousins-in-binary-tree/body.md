## Record depth and parent

DFS with `(node, parent, depth)`:

- If `node.val == x`, store `(depthX, parentX)`; same for `y`.
- Recurse into both children.

Return `depthX == depthY and parentX != parentY`.

BFS works too: process one level at a time; if both appear in the same level and are not children of the same node, they are cousins. If only one appears in a level, they are not.

Values are unique, so each of `x` and `y` is found once.

Do not count siblings as cousins. Do not compare only depths.

Time: O(n)  
Space: O(h) for DFS, O(w) for BFS

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
