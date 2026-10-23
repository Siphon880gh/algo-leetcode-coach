## Tiny example

A double-ended queue lets both ends move:

```
deque = [10, 20]
push_back 30  → [10, 20, 30]
push_front 5  → [5, 10, 20, 30]
pop_front     → returns 5,  deque = [10, 20, 30]
pop_back      → returns 30, deque = [10, 20]
```

## Why not always use a deque?

Stack = one end. Queue = front out / rear in. Deque = both ends. Extra power is great for sliding-window maxima and 0-1 BFS; it is overkill when a plain stack/queue already matches the problem.

## Ops (amortized with a good ring buffer)

1. push/pop at front — O(1)
2. push/pop at back — O(1)
3. random mid index — still O(n) unless you add extra structure

## Trap

Calling it a “queue” in your head but popping the rear in BFS.

**Fix:** Name the ADT you mean. BFS needs front-out. Sliding-window max needs both ends with a monotonic deque pattern.

**Time:** O(1) end ops  
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
