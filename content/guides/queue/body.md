## Tiny example

Enqueue three values, then dequeue one:

```
queue = []
enqueue 3:  [3]
enqueue 1:  [3, 1]
enqueue 4:  [3, 1, 4]
dequeue:    returns 3, queue = [1, 4]
```

This is first in, first out (**FIFO**). Items leave from the front, and new items join at the rear.

## Where it shows up

1. BFS level order. Neighbors join at the rear and leave from the front.
2. Task and print queues, where the order must be fair.
3. Sliding-window variants that use a deque (a double-ended queue).

## Operations

| Operation | Cost (good implementation) |
|-----------|----------------------------|
| enqueue at the rear, dequeue from the front | O(1) |
| peek at the front | O(1) |

A naive "queue" built with `pop(0)` on a dynamic array costs O(n) per dequeue. Use a real deque or a ring buffer instead.

## Trap

Using a stack (LIFO) for BFS, and wondering why the levels get mixed up.

**Fix:** BFS needs FIFO order. Depth-first exploration uses a stack or recursion.

**Time:** O(1) per enqueue and per dequeue  
**Space:** O(n)

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
