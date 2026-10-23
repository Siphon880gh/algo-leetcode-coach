## Tiny example

Items `(weight, value)`: `(10,60), (20,100), (30,120)`, capacity `50`. Fractions allowed.

Value density: `6`, `5`, `4`. Greedy:

1. Take all of first (10) → value 60, remain 40
2. Take all of second (20) → value 100, remain 20
3. Take `20/30` of third → value 80

Total **240**. Optimal because fractions are allowed.


## How

1. Sort by value/weight descending
2. Take whole items while they fit
3. Take a fraction of the next item to fill the bag


## Trap

Using this greedy on **0-1** knapsack (no fractions) — it can be wrong.

**Fix:** If fractions are forbidden, switch to DP. Density greedy needs the fractional model.

**Time:** O(n log n) sort · **Space:** O(1) extra beyond sort

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
