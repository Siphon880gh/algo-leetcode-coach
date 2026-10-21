Given a sorted list of disjoint intervals and one interval to remove, return the sorted list of what remains of the original intervals. Intervals are typically half-open `[a, b)`; check the statement. For instance, removing `[1,6]` from `[[0,2],[3,4],[5,7]]` gives `[[0,1],[6,7]]`, and removing `[2,3]` from `[[0,5]]` gives `[[0,2],[3,5]]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Clip each interval

For each `[x, y]` with removal `[a, b]`:
- `y ≤ a` or `x ≥ b`: keep `[x, y]`.
- Else: if `x < a`, keep `[x, a]`; if `y > b`, keep `[b, y]`.

The input is sorted, so the output stays sorted.

Do not drop an interval that only partly overlaps; keep its outside pieces. Do not split an interval contained inside the removal; it disappears entirely.

Time: O(n)  
Space: O(1) besides the output

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
