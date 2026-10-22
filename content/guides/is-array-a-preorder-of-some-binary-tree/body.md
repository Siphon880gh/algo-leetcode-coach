You get a list of nodes, each giving its own id and its parent’s id, with the root having no parent. Decide whether the list, in the given order, is a preorder traversal of the tree those parent links describe, for some order of each node’s children. The input format and limits are in the official statement. For instance, with root 0, children 1 and 2 of 0, and children 3 and 4 of 2, the order 0, 1, 2, 3, 4 is a preorder; if 3 and 4 are children of 1 instead, it is not. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Current path

1. The first node must be the root; push it.
2. For each next node: pop while the top is not its parent; if the stack empties, return false; push the node.
3. Return true.

Constructed checks (run in code): the examples above → true, false; 500 random binary trees, half listed in a real preorder and half shuffled, match a check that every subtree occupies one contiguous block starting at its root.

Popping is safe: once preorder leaves a subtree, it never returns to it, so nodes above the parent can no longer receive children.

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
