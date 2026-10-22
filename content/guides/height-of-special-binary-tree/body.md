In a binary tree, the leaves are also linked to each other in a cycle through their child pointers, so a plain traversal would loop forever. Return the height of the tree. How the leaf links are set, the height convention, and the limits are in the official statement. For instance, a root with children 2 and 3, where 2 has a left child 4, has height 2 counted in edges, whatever the leaf links are. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Real children only

This assumes the usual linking: a leaf’s right pointer goes to the next leaf and that leaf’s left pointer comes back. Adapt the test if the statement links them differently.

1. `h(node)`: best = 0.
2. If `node.left` exists and `node.left.right ≠ node`: best = max(best, 1 + h(node.left)). Likewise for `node.right` with `node.right.left ≠ node`.
3. Return best (add 1 if the statement counts nodes).

Constructed checks (run in code): the example above → 2; 400 random trees with their leaves linked in a cycle give the same height as before linking.

A real child never points back at its parent, so the test never skips a true edge. Even a single leaf, linked to itself, is handled.

Time: O(n)  
Space: O(height)

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
