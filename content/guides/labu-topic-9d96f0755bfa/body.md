## Tiny example

Compare the cost of two recursions.

- `sum(n) = n + sum(n-1)` makes **n** calls in a single chain, n deep. Time is O(n) and space is O(n).
- Naive `fib(n)` makes two calls at every level, so the call tree explodes. Time is Θ(φⁿ), while space is only O(n), because the deepest chain is n calls long.

Time follows **how many calls do work**. Space follows the **maximum depth**.

## How

1. Draw the call tree and estimate its size.
2. Take the depth as the space cost (roughly).
3. Add a memo when the tree visits the same states again.

## Trap

Saying recursive Fibonacci takes O(n) time because the formula mentions n.

**Fix:** Count the nodes in the call tree, not the size of the parameter.

**Naive Fibonacci:** exponential time · **Memoized Fibonacci:** O(n) time

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
