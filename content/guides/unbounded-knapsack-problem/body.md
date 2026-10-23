## Tiny example

Items `(1,15), (3,20), (4,30)`, capacity **4**, **unlimited** copies.

Best: four copies of `(1,15)` → **60**.

1D array starts `dp = [0, 0, 0, 0, 0]`.

Process `(1,15)` scanning **c = 1 → 4** (forward):

1. c=1: `dp[1] = 15`
2. c=2: `dp[2] = dp[1]+15 = 30`
3. c=3: `dp[3] = 45`
4. c=4: `dp[4] = 60`

Forward scan is the point: `dp[c-w]` may **already** include earlier copies of this same item.

## How

1. `dp[c]` = best value for capacity c
2. For each item `(w,v)`, loop `c` from `w` **up** to `W`
3. `dp[c] = max(dp[c], dp[c-w] + v)`
4. Answer `dp[W]`

## Trap

Using the backward 0-1 loop while repeats are allowed — you under-pack.

**Fix:** Unlimited copies ⇒ forward capacity loop.

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
