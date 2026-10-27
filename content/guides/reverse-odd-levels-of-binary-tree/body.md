## Mirror pairs

1. `go(a, b, level)`: if `a` is null, stop; if `level` is odd, swap the values of `a` and `b`.
2. Recurse on `(a.left, b.right, level + 1)` and `(a.right, b.left, level + 1)`.
3. Call `go(root.left, root.right, 1)`; return `root`.

Examples → [2,5,3,8,13,21,34], [7,11,13], [0,2,1,0,0,0,0,2,2,2,2,1,1,1,1].

Only values move, so the shape stays perfect. A level-by-level BFS that reverses the values of each odd level works too. The tree has at most 2^14 nodes and depth 13, so recursion is safe.

Time: O(n)  
Space: O(log n) for recursion

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
