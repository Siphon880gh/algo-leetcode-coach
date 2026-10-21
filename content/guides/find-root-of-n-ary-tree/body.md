All nodes of an N-ary tree with unique values are given in arbitrary order. Return the root node. For instance, with nodes 1 (children 2, 3) and 3 (child 4), only node 1 is never anyone's child, so it is the root. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sum (or XOR) cancellation

1. `s = Σ node.val − Σ child.val` over all nodes (XOR works the same).
2. Return the node with `val == s`.

Nodes 1→{2,3}, 3→{4}: sum 1+2+3+4 − (2+3+4) = 1 → node 1.

A set of child references also works with O(n) space. Do not assume the first node in the list is the root.

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
