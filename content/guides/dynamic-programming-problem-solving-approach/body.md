## Tiny example

Climbing stairs: `n=4` ways (1/2 steps).

Playbook:

1. **Brute recursion:** `f(i)=f(i-1)+f(i-2)`
2. **Memo** on `i`
3. **Table** `dp[i]` bottom-up
4. **Compress** to two variables

Same relation; changing only the evaluation strategy.


## How

1. Define state + transition on paper
2. Memoize top-down until correct
3. Translate bottom-up; then drop dimensions if safe


## Trap

Jumping straight to a rolled 1D loop before the transition is trustworthy.

**Fix:** Get the recursive definition right first — compression is last.

**Time:** usually O(states × transitions) · **Space:** shrinks across the playbook

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
