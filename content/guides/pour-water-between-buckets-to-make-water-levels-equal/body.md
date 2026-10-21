You are given buckets, where buckets[i] is the water in the i-th bucket, and an integer loss (a percentage). Pouring k gallons from one bucket to another spills loss percent of k, so the receiver gets k · (1 − loss / 100). Return the maximum level all buckets can reach equally, within the tolerance the statement gives. For instance, [1,2,7] with loss 80 → 2.0; [2,4,6] with loss 50 → 3.5; [3,3,3,3] with loss 40 → 3.0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Supply versus demand at level x

1. `give(x) = Σ (b − x)` over `b > x`, `need(x) = Σ (x − b)` over `b < x`.
2. Feasible iff `give(x) · (1 − loss / 100) ≥ need(x)`.
3. Binary search for the largest feasible `x` (about 100 halvings, or until the interval is below the tolerance).

Constructed checks (computed with the same test and confirmed by hand): the three cases above → 2.0, 3.5, 3.0.

Raising x lowers the supply and raises the demand, so feasibility flips once. Pouring directly from each full bucket into each empty one is enough; chaining pours only spills more.

Time: O(n · iterations)  
Space: O(1)

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
