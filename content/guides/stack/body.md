## Tiny example

Push then pop:

```
stack = []
push 3 → [3]
push 1 → [3, 1]
push 4 → [3, 1, 4]
pop    → returns 4, stack = [3, 1]
```

Last in, first out (**LIFO**). Only the **top** moves.

## Where it shows up

1. Matching brackets — push opens, pop on close
2. Undo history — each edit pushed, undo pops
3. DFS / recursion simulation — frames on a stack
4. Monotonic stack — next greater/smaller element patterns

## Ops

| Op | Cost |
|----|------|
| push / pop / peek top | O(1) |
| search deep value | O(n) |

## Trap

Using a stack but peeking/removing from the **bottom** (or indexing the middle) as if it were a deque/array of equal cost.

**Fix:** If you need both ends, use a deque. A stack’s contract is top-only.

**Time:** O(1) per push/pop  
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
