## Tiny example

Numbers `{3, 1, 5}`, target **6**.

Walk include/exclude from the left:

```
sum = 0, left = [3, 1, 5]
```

1. Skip 3 → sum 0; take 1 → sum 1; take 5 → sum **6** ✓ subset `{1,5}`
2. Other branches: `{3,1,5}` overshoots; `{3}` stays at 3; `{5}` stays at 5

Boolean DP view: start with reachable = `{0}`. Adding 3 → `{0,3}`; adding 1 → `{0,1,3,4}`; adding 5 → `{0,1,3,4,5,6,8,9}`. Target 6 is present.

## How

1. Backtracking: at each index, try skip or take; prune when `sum > target`
2. Or DP: `reach[s] = true` if some subset sums to `s`; update each number **backward** over sums (0-1)
3. Answer: whether `reach[target]` (or list one subset from the search tree)

## Trap

Updating reachable sums **forward** so one number is added twice in the same pass.

**Fix:** For classic 0-1 subset sum, scan sums from `target` down to `num`.

**Time:** O(n · target) for the boolean array (or O(2ⁿ) search)  
**Space:** O(target) or O(n) recursion

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
