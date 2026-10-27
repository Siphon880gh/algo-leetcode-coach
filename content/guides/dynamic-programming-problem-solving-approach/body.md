## Tiny example

Climbing stairs: you climb 1 or 2 steps at a time. With `n = 4` there are 5 ways to reach the top.

The playbook has four stages:

1. **Plain recursion:** `f(i) = f(i-1) + f(i-2)`.
2. **Memoization:** cache each `f(i)` the first time you compute it.
3. **Table:** fill `dp[i]` from the bottom up.
4. **Compress:** keep only the last two values in two variables.

The recurrence stays the same in every stage. Only the way you evaluate it changes.

## How

1. Write the state and the transition on paper.
2. Add memoization to the top-down recursion and check that it is correct.
3. Turn it into a bottom-up table, then drop dimensions you no longer need.

## Trap

Jumping straight to a compressed one-dimensional loop before you trust the transition.

**Fix:** Get the recursive definition right first. Compression comes last.

**Time:** usually O(number of states × transitions per state) · **Space:** shrinks as you move through the stages

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
