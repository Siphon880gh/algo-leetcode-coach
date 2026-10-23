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

Every DP solution names **four** pieces the same way:

1. **State** — what does one cell mean? Here: `f(i)` = the i-th Fib number
2. **Transition** — how do you build it? `f(i) = f(i-1) + f(i-2)`
3. **Base cases** — where do you start? `f(0)=0`, `f(1)=1`
4. **Order** — which cells first? Increasing `i` so smaller indices exist

If you cannot say those four out loud, nested loops will feel random.

## How

1. Write one sentence for the state
2. Write the transition from smaller states
3. Pin bases that need no recursion
4. Choose bottom-up order (or top-down + memo) that respects dependencies

## Trap

Coding a 2D array before you can say what `dp[i]` means.

**Fix:** State sentence first; dimensions follow from the sentence.

**Habit:** state → transition → base → order

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
