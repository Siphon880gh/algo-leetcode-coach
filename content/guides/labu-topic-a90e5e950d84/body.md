## Tiny example

Write the first Fibonacci numbers by hand:

```
f(0)=0
f(1)=1
f(2)=0+1=1
f(3)=1+1=2
f(4)=1+2=3
f(5)=2+3=5
```

Every DP solution names the same **four** pieces:

1. **State:** what does one cell mean? Here, `f(i)` is the i-th Fibonacci number.
2. **Transition:** how do you build it? `f(i) = f(i-1) + f(i-2)`.
3. **Base cases:** where do you start? `f(0)=0` and `f(1)=1`.
4. **Order:** which cells come first? Increasing `i`, so the smaller indices already exist.

If you cannot say these four out loud, the nested loops will feel random.

## How

1. Write one sentence describing the state.
2. Write the transition from smaller states.
3. Fix the base cases that need no recursion.
4. Choose a bottom-up order, or top-down with a memo, that respects the dependencies.

## Trap

Coding a 2D array before you can say what `dp[i]` means.

**Fix:** Write the state sentence first. The dimensions follow from it.

**Habit:** state, then transition, then base cases, then order

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
