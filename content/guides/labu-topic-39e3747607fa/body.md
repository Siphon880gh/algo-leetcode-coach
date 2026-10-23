## Tiny example

Binary tree skill map — learn in order on a small tree `1,(2,3)`:

1. Traverse (DFS orders + BFS levels)
2. Recurse on left/right for answers (height, diameter pieces)
3. Specialize: BST invariants, heap shape

Do not jump to AVL rotations before you can traverse confidently.


## How

1. Master walk orders
2. Write divide-and-conquer on left/right
3. Then study BST/heap rules


## Trap

Memorizing BST insert before knowing inorder/preorder.

**Fix:** Traversal fluency first.

**Time:** walks O(n)

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
