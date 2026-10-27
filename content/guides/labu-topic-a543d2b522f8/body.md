## Tiny example

Recursive traversals on a tree with root `1`, left child `2` and right child `3`:

- **Preorder** visits the node **before** both recursive calls, giving `1, 2, 3`.
- **Inorder** visits it **between** the calls, giving `2, 1, 3`.
- **Postorder** visits it **after** both calls, giving `2, 3, 1`.

The recursion is the same in all three. Only the line that visits the node moves.

## How

1. Write the three versions:
   - preorder: visit, left, right
   - inorder: left, visit, right
   - postorder: left, right, visit
2. Trace one tiny tree by hand.
3. Reuse the version that matches the order a problem needs.

## Trap

Assuming inorder always prints sorted values, even on trees that are not binary search trees.

**Fix:** Inorder is sorted only when the tree keeps the binary search tree invariant.

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
