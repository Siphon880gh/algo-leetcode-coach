## Largest first

`total = 0`. `visit(node)`:

- If `node` is null, return.
- `visit(node.right)`.
- `total += node.val`; `node.val = total`.
- `visit(node.left)`.

Call `visit(root)` and return `root`.

Use an explicit stack or Morris traversal to avoid recursion if needed; the order stays right, node, left.

Do not compute subtree sums separately for each node; that is O(n²) on a skewed tree. Do not visit left first; that adds smaller values instead of greater ones.

Time: O(n)  
Space: O(h)

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
