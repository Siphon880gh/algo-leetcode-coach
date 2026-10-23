## Tiny example

Recursion cost on Fib vs linear sum.

- `sum(n)=n+sum(n-1)`: **n** calls, depth n → time O(n), space O(n)
- Naive `fib(n)`: exploding tree → time Θ(φⁿ), space O(n) depth

Time follows **how many calls do work**; space follows **maximum depth**.


## How

1. Draw the call tree size
2. Depth = space (approx)
3. Add memo when the tree re-touches states


## Trap

Saying Fib recursion is O(n) time because the formula mentions n.

**Fix:** Count nodes in the call tree, not the parameter name.

**Fib naive:** exponential time · **Memo Fib:** O(n) time

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
