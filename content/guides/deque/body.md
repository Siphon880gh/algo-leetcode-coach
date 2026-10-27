## Tiny example

A double-ended queue (deque) lets you add and remove at both ends:

```
deque = [10, 20]
push_back 30  → [10, 20, 30]
push_front 5  → [5, 10, 20, 30]
pop_front     → returns 5,  deque = [10, 20, 30]
pop_back      → returns 30, deque = [10, 20]
```

## Why not always use a deque?

A stack uses one end. A queue adds at the back and removes from the front. A deque can do both at both ends.

That extra power is exactly what sliding-window maximum and 0-1 BFS need. When a plain stack or queue already fits the problem, the simpler structure is easier to read.

## Operations

With a good ring buffer, these are O(1) amortized:

1. Push or pop at the front: O(1).
2. Push or pop at the back: O(1).
3. Reading an index in the middle can still be O(n), unless the implementation adds extra structure.

## Trap

Thinking of it as a "queue" but popping from the back during BFS.

**Fix:** Say which behavior you need. BFS removes from the front. Sliding-window maximum uses both ends with a monotonic deque.

**Time:** O(1) for operations at either end  
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
