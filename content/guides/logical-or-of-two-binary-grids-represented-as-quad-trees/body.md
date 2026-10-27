## Let leaves short-circuit

`or(a, b)`:

- If `a` is a leaf: if `a.val` is true, the whole block is 1 → return a leaf with true (or `a`). If false, the OR is just `b` → return `b`.
- Same if `b` is a leaf.
- Otherwise recurse on the four pairs of children.

After recursion, if all four results are leaves with the same `val`, return one leaf with that value instead — a quad-tree must not split a uniform block.

You never build the grid, so the work is bounded by the size of the trees.

Construct Quad Tree (427) builds one from a grid.

Do not forget the merge step — four equal leaves must collapse. Do not expand leaves into full subtrees; a 1-leaf already decides the whole block.

Time: O(nodes of both trees)  
Space: O(depth) recursion plus new nodes

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
