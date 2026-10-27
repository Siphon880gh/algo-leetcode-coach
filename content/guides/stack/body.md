## Tiny example

Push three values, then pop one:

```
stack = []
push 3:  [3]
push 1:  [3, 1]
push 4:  [3, 1, 4]
pop:     returns 4, stack = [3, 1]
```

This is last in, first out (**LIFO**). Only the **top** changes.

## Where it shows up

1. Matching brackets. Push each opening bracket, and pop when you see a closing one.
2. Undo history. Each edit is pushed, and undo pops it.
3. DFS, or simulating recursion. The frames sit on a stack.
4. Monotonic stacks, for finding the next greater or smaller element.

## Operations

| Operation | Cost |
|-----------|------|
| push, pop, or peek at the top | O(1) |
| search for a value deeper down | O(n) |

## Trap

Using a stack but reading or removing from the **bottom** (or the middle), as if it were a deque or an array with the same cost.

**Fix:** If you need both ends, use a deque. A stack only promises access to the top.

**Time:** O(1) per push and per pop  
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
