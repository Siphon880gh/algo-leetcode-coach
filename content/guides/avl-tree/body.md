## Tiny example

Insert `1`, `2` and `3`, in that order, into an empty AVL tree.

1. Insert `1`. Then insert `2`, which becomes the right child of `1`.
2. Insert `3`, which goes to the right of `2`. Now the tree leans right twice, and the balance factor at `1` becomes `-2`.
3. Do a **left rotation** around `1`. Now `2` is the root, with `1` on its left and `3` on its right.

The tree is balanced again: every balance factor is between −1 and 1.

## How

1. Insert or delete exactly as in a plain binary search tree.
2. Walk back up toward the root, updating each node's height.
3. If a node's balance factor goes below −1 or above 1, rotate. There are four cases: LL, RR, LR and RL.

## Trap

Treating an AVL tree like a plain binary search tree and skipping the rotations after an update.

**Fix:** Rotations are the whole point. They keep searches **O(log n)** even in the worst case.

**Time:** O(log n) per operation · **Space:** O(n)

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
