## Tiny example

Bag capacity **4**. Items (weight, value):

- `(1, 15)`
- `(3, 20)`
- `(4, 30)`

Each item **at most once**.

Picture the choices:

- Take only `(4,30)` → value 30
- Take `(1,15)` + `(3,20)` → value **35** ✓
- Take `(1,15)` alone → 15

1D DP: `dp[c]` = best value with capacity c. For each item, update **c from 4 down to w**:

```
dp[c] = max(dp[c], dp[c - w] + v)
```

Backward order keeps `dp[c-w]` meaning “without this item”.

## How

1. Start `dp` all zeros
2. For each item, scan capacities high → low
3. Take-or-skip via the `max` above
4. Answer `dp[W]`

## Trap

Scanning capacity upward — the same item can be counted twice (you accidentally solved unbounded).

**Fix:** 0-1 ⇒ backward. Unbounded ⇒ forward.

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
