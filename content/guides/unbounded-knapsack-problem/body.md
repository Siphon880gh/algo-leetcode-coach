## Tiny example

The items are `(1,15)`, `(3,20)` and `(4,30)`, written as (weight, value). The capacity is **4**, and you may take **unlimited** copies.

The best packing is four copies of `(1,15)`, worth **60**.

The one-dimensional array starts as `dp = [0, 0, 0, 0, 0]`.

Process `(1,15)`, scanning **c from 1 up to 4** (forward):

1. At c = 1: `dp[1] = 15`.
2. At c = 2: `dp[2] = dp[1] + 15 = 30`.
3. At c = 3: `dp[3] = 45`.
4. At c = 4: `dp[4] = 60`.

The forward scan is the whole point: `dp[c-w]` may **already** include earlier copies of the same item.

## How

1. `dp[c]` is the best value for capacity c.
2. For each item `(w,v)`, loop `c` **up** from `w` to `W`.
3. Set `dp[c] = max(dp[c], dp[c-w] + v)`.
4. The answer is `dp[W]`.

## Trap

Using the backward loop from 0-1 knapsack when repeats are allowed. You pack too little.

**Fix:** When copies are unlimited, loop the capacity forward.

**Time:** O(nW)  
**Space:** O(W)

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
