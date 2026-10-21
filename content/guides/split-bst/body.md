Given the root of a BST and a value `target`, split the tree into two BSTs: one with all nodes `≤ target` and one with all nodes `> target`. Keep the original parent-child relationships wherever possible, and return the two roots. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Only one path changes

`split(node)`:

- null → `(null, null)`.
- `node.val ≤ target`: `(s, l) = split(node.right)`. Set `node.right = s`. Return `(node, l)`.
- Otherwise: `(s, l) = split(node.left)`. Set `node.left = l`. Return `(s, node)`.

Only the nodes on the search path for `target` are touched, so most of the structure is kept. Each step re-attaches one subtree, which preserves the BST order.

Do not rebuild the two trees by inserting nodes one at a time; that loses the structure and costs O(n log n) or worse. Do not split by value comparison at every node in the tree; only the search path needs work.

Time: O(h)  
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
