## Tiny example

Multiple / bounded knapsack: item i may be taken up to `k_i` times.

Tiny case: item weight 2, value 5, `k=2`, `W=5`. Options: 0,1, or 2 copies → best value `10` (two copies) with weight 4.

Approaches:

1. Expand into `k` separate 0-1 items (naive)
2. Binary split counts (`1,2,4,…` packs) then 0-1
3. Loop a multiplicity dimension carefully


## How

1. Encode the multiplicity limit in the model
2. Prefer binary splitting when k is large
3. Fall back to 0-1 DP after expansion


## Trap

Treating bounded items as unbounded (forward loop without a count cap).

**Fix:** Cap copies via expansion or an explicit count loop.

**Time:** depends on expansion; binary split ≈ O(n log k · W) · **Space:** O(W)

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
