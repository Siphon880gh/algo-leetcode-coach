## Tiny example

Iterative traversals:

- **BFS by levels:** use a queue. It visits `1`, then `2, 3`, and so on, level by level.
- **DFS preorder:** use a stack. Push the right child and then the left child, so the left one is popped first.
- **Inorder and postorder** done iteratively need a state mark on each node, or a two-stack trick.

You get the same orders as with recursion, using an explicit structure instead of the call stack.

## How

1. For BFS, use a queue.
2. For preorder, use a stack and push the children in the right order.
3. For inorder and postorder, mark each node as "expand" or "visit" if needed.

## Trap

Using one stack exactly like recursion without storing which phase each node is in, then wondering why postorder breaks.

**Fix:** Store a phase flag with each node on the stack.

**Time:** O(n) · **Space:** O(n) in the worst case, for the widest level or the deepest path

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
