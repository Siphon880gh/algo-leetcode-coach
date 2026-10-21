Design `serialize` and `deserialize` for a binary search tree with 0 to 1e4 nodes, values 0 to 1e4. Any format works, but it should be as compact as possible. `[2,1,3]` round-trips to `[2,1,3]`. `[]` round-trips to `[]`.

## Preorder plus BST bounds

Serialize: write the preorder values (`node, left subtree, right subtree`) separated by spaces. No null markers are needed.

Deserialize: keep an index into the value list and recurse with bounds `(low, high)`. If the next value is outside the bounds, this subtree is empty — return null without consuming it. Otherwise make a node, advance the index, build the left subtree with `(low, value)`, then the right with `(value, high)`. Every value is read once.

Why no nulls: in a BST, the first value of the preorder is the root, everything smaller that follows belongs to the left subtree, and everything larger to the right. The bounds encode exactly that split.

Serialize and Deserialize Binary Tree (297) has no ordering, so it must record nulls. Construct Binary Search Tree from Preorder Traversal (1008) is the deserialize half.

Do not write null markers (not compact). Do not search for the split point with a linear scan at every node — that is O(n²) on a skewed tree. Do not skip the empty tree.

Time: O(n) for each direction  
Space: O(n) for the string, O(h) recursion

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
