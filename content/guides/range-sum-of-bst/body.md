## Skip whole subtrees

`sum(node)`:

- `None` → 0.
- `node.val < low` → `sum(node.right)`.
- `node.val > high` → `sum(node.left)`.
- Otherwise → `node.val + sum(node.left) + sum(node.right)`.

The BST order guarantees that everything left of a too-small node is also too small, and the other way round.

Do not visit every node and filter; it works, but pruning skips subtrees outside the range. Do not use strict bounds; low and high are inclusive.

Time: O(n) worst case, less when pruning helps  
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
