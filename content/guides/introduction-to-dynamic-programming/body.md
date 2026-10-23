## Tiny example

Naive recursion for Fib(5) draws a tree that computes Fib(3) **twice**, Fib(2) many times:

```
F(5)
 ├─ F(4)
 │   ├─ F(3)
 │   └─ F(2)
 └─ F(3)   ← same work again
```

Bottom-up on a line instead:

```
i:     0  1  2  3  4  5
f(i):  0  1  1  2  3  5
```

Each index once. Two running variables are enough — O(n) time, O(1) extra space.

DP = overlapping subproblems + optimal substructure, **cached**.

## How

1. Write the recursive relation on a tiny n
2. Notice repeated calls
3. Memoize or fill a table in dependency order
4. Compress to a few variables when only recent states matter

## Trap

Memoizing a tree of **unique** subproblems — map overhead buys nothing.

**Fix:** Confirm the same state is asked more than once before adding a cache.

**Fib time:** O(n) with DP vs exponential naive

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
