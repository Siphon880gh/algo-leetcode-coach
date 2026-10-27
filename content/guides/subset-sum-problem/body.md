## Tiny example

The numbers are `{3, 1, 5}`, and the target is **6**.

Decide for each number, from left to right, whether to include it:

```
sum = 0, left = [3, 1, 5]
```

1. Skip 3, so the sum stays 0. Take 1, so the sum is 1. Take 5, so the sum is **6**. The subset `{1,5}` works.
2. Other branches fail. `{3,1,5}` overshoots, `{3}` stops at 3 and `{5}` stops at 5.

The same problem as a boolean DP: start with the reachable sums `{0}`.

1. Adding 3 gives `{0,3}`.
2. Adding 1 gives `{0,1,3,4}`.
3. Adding 5 gives `{0,1,3,4,5,6,8,9}`.

The target 6 is in the set.

## How

1. With backtracking, try skipping and taking the number at each index. Prune when `sum > target`.
2. Or with DP, set `reach[s] = true` when some subset sums to `s`. For each number, update the sums **backward** (this is 0-1).
3. The answer is whether `reach[target]` is true. The search tree can also list one subset.

## Trap

Updating the reachable sums **forward**, so one number is added twice in the same pass.

**Fix:** For classic 0-1 subset sum, scan the sums from `target` down to `num`.

**Time:** O(n · target) with the boolean array (or O(2ⁿ) with search)  
**Space:** O(target), or O(n) for the recursion

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
