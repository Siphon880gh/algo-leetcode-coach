Given the root of an N-ary tree (each node has a value and a list of children), return a deep copy of the tree. For instance, a root 1 with children 3, 2, 4, where 3 has children 5 and 6, must be copied with the same shape and values. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Copy node, then children

1. `clone(node)`: if null, return null.
2. `c = Node(node.val)`; for each child in order, append `clone(child)`.
3. Return `c`.

Do not copy the children list by reference; the copy must not share nodes. A BFS with a queue of (original, copy) pairs avoids deep recursion.

Time: O(n)  
Space: O(height) recursion

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
