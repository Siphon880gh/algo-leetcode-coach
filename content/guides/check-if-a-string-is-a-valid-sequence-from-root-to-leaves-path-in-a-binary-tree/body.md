Given a binary tree and an array, decide whether the array equals the values along some path from the root to a leaf. For instance, the tree `[0,1,0,0,1,0,null,null,1,0,0]` with `[0,1,0,1]` is valid, while a sequence that stops before reaching a leaf is not. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Match and end at a leaf

1. `ok(node, i)`: false if `node` is null, `i == len`, or `node.val ≠ arr[i]`.
2. If `i == len − 1`, return whether `node` is a leaf.
3. Else return `ok(node.left, i + 1) or ok(node.right, i + 1)`.

Do not accept a match that ends at an inner node; the path must reach a leaf. Do not continue past the array length.

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
