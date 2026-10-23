## Tiny example

We reuse the bag and items from the 2D lesson:

- A `(1,15)`, B `(3,20)`, C `(4,30)`, capacity **4**
- Still each item **once**
- Still answer **35**

Instead of a full table, keep one array `dp[0…4]` = best value for that capacity **so far**.

Start: `dp = [0, 0, 0, 0, 0]`

Process A `(1,15)` scanning **c = 4, 3, 2, 1**:

1. c=4: `dp[4] = max(0, dp[3]+15) = 15`
2. c=3: `dp[3] = 15`
3. c=2: `dp[2] = 15`
4. c=1: `dp[1] = 15`

Now `dp = [0, 15, 15, 15, 15]`.

Process B `(3,20)` scanning **c = 4, 3**:

1. c=4: `max(15, dp[1]+20) = 35`
2. c=3: `max(15, dp[0]+20) = 20`

Now `dp = [0, 15, 15, 20, 35]`.

Why **high → low**? When you update `dp[4]`, `dp[1]` still means “before this item”. If you scanned low → high, `dp[1]` would already include A *and* you could layer A again.

## How

1. `dp[c] = 0` for all c
2. For each item `(w,v)`, loop `c` from `W` down to `w`
3. `dp[c] = max(dp[c], dp[c-w] + v)`
4. Answer `dp[W]`

## Trap

Looping `c` upward (0-1 broken → item reused).

**Fix:** Backward for 0-1; forward only when repeats are allowed.

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
