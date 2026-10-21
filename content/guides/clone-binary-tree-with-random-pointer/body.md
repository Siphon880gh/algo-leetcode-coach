Each node of a binary tree has left, right, and a random pointer that may point to any node or null. Return a deep copy, built from the copy node class the statement specifies, with the same structure and random links. For instance, if a leaf's random points to the root, the copy's leaf must point to the copy's root. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Memoised copy

1. `copy(node)`: if null, return null; if in `map`, return `map[node]`.
2. Create `c`, store `map[node] = c` before recursing.
3. `c.left = copy(left)`, `c.right = copy(right)`, `c.random = copy(random)`.

Do not recurse before storing the copy; random links can form cycles. Do not point copy nodes at original nodes.

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
