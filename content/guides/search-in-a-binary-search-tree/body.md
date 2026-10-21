## One path down

Start at the root:

- `node.val == val` → return `node` (the whole subtree is the answer).
- `val < node.val` → `node = node.left`.
- `val > node.val` → `node = node.right`.
- `node` is null → return null.

The loop needs no extra space; the recursive version uses O(h) stack.

Do not search both subtrees; that ignores the BST order and costs O(n). Do not copy the subtree; return the existing node.

Time: O(h)  
Space: O(1) iterative

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
