## Tiny example

Plain recursion for Fib(5) draws a call tree that computes Fib(3) **twice** and Fib(2) several times:

```
F(5)
 ├─ F(4)
 │   ├─ F(3)
 │   └─ F(2)
 └─ F(3)   ← same work again
```

Instead, fill the values from the bottom up along a line:

```
i:     0  1  2  3  4  5
f(i):  0  1  1  2  3  5
```

Each index is computed once. Two running variables are enough, so this takes O(n) time and O(1) extra space.

Dynamic programming means you **cache** the answers to subproblems that repeat, when the best answer builds from smaller best answers.

## How

1. Write the recursive relation and try it on a tiny n.
2. Notice which calls repeat.
3. Memoize, or fill a table in the order the values depend on each other.
4. When only the last few states matter, keep just a few variables.

## Trap

Adding a memo to a recursion where every subproblem is **different**. The cache costs memory and saves nothing.

**Fix:** Check that the same state really is asked for more than once before adding a cache.

**Fibonacci time:** O(n) with DP, compared with exponential time for plain recursion

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
