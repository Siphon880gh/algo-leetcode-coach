## Tiny example

One item: weight **2**, value **3**. Capacity **4**. Unlimited copies.

```
dp = [0, 0, 0, 0, 0]
```

Scan **c = 2 → 4**:

1. c=2: `dp[2] = max(0, dp[0]+3) = 3`
2. c=3: stays 0 (no fit improvement)
3. c=4: `dp[4] = max(0, dp[2]+3) = 6` ← second copy

Forward order is why copy #2 sees copy #1. Backward would freeze at 3.

## How

1. Confirm the problem allows many copies
2. For each item, loop capacity **low → high**
3. `dp[c] = max(dp[c], dp[c-w] + v)`
4. Answer `dp[W]`

## Trap

Using the 0-1 backward loop — you under-count copies.

**Fix:** Unlimited ⇒ forward.

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
