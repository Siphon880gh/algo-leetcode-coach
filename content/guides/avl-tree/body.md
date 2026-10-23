## Tiny example

Insert `1, 2, 3` into an empty AVL.

1. Insert `1`, then `2` → right child
2. Insert `3` → right-right chain; balance factor at `1` becomes `-2` (right-heavy)
3. **Left rotate** around `1` → root `2` with left `1` and right `3`

Height is balanced again (|balance factor| ≤ 1 everywhere).

## How

1. BST insert/delete
2. Walk back up; update heights
3. If a node’s |bf| > 1, rotate (LL, RR, LR, RL cases)

## Trap

Treating AVL like an unbalanced BST and skipping rotations after updates.

**Fix:** Rotations are the point — they keep search **O(log n)** worst case.

**Time:** O(log n) per op · **Space:** O(n)

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
