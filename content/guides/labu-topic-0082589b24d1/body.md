## Tiny example

There is one item with weight **2** and value **3**. The capacity is **4**, and you may take as many copies as you like.

```
dp = [0, 0, 0, 0, 0]
```

Scan **c from 2 up to 4**:

1. At c = 2: `dp[2] = max(0, dp[0] + 3) = 3`.
2. At c = 3: nothing improves, so `dp[3]` stays 0.
3. At c = 4: `dp[4] = max(0, dp[2] + 3) = 6`. This is the second copy.

Scanning forward is what lets the second copy build on the first. Scanning backward would stop at 3.

## How

1. Check that the problem allows many copies of an item.
2. For each item, loop the capacity from **low to high**.
3. Set `dp[c] = max(dp[c], dp[c - w] + v)`.
4. The answer is `dp[W]`.

## Trap

Using the backward loop from 0-1 knapsack. You undercount the copies.

**Fix:** When copies are unlimited, scan forward.

**Time:** O(nW) · **Space:** O(W)

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
