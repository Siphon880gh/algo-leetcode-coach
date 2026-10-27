## Tiny example

One loop can produce all three traversal orders. Push pairs of `(node, state)` onto a stack.

Use two states:

- **First seen (WHITE):** the node has not been expanded. When you pop it, push its children and push the node itself again, in the order you need, with the node marked "ready".
- **Ready (BLACK):** when you pop it, add it to the output.

Where you push the node back, relative to its children, decides whether you get preorder, inorder or postorder.

## How

1. Push `(root, WHITE)`.
2. Pop. If the node is WHITE, push its children and the node itself, with new states, in the order you need.
3. If the node is BLACK, append it to the answer.

## Trap

Pushing the children without pushing the node again for its visit step, in inorder or postorder.

**Fix:** For those orders, the node itself must go back on the stack in the "ready" state.

**Time:** O(n) · **Space:** O(h)

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
