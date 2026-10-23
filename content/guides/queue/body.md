## Tiny example

Enqueue then dequeue:

```
queue = []
enqueue 3 → [3]
enqueue 1 → [3, 1]
enqueue 4 → [3, 1, 4]
dequeue   → returns 3, queue = [1, 4]
```

First in, first out (**FIFO**). Front leaves first; rear accepts new items.

## Where it shows up

1. BFS level order — neighbors enter the rear, leave the front
2. Task / print spoolers — fair ordering
3. Sliding-window variants with a deque (double-ended queue)

## Ops

| Op | Cost (good implementation) |
|----|------------------------------|
| enqueue rear / dequeue front | O(1) |
| peek front | O(1) |

A naive “queue” built by `pop(0)` on a dynamic array is O(n) per dequeue — prefer a real deque/ring buffer.

## Trap

Using a stack (LIFO) for BFS and wondering why levels scramble.

**Fix:** BFS needs FIFO. DFS-style exploration uses a stack/recursion.

**Time:** O(1) per enqueue/dequeue  
**Space:** O(n)

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
