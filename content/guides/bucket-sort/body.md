## Tiny example

Sort floats roughly uniform in `[0, 1)`: `[0.42, 0.11, 0.75, 0.08]`.

1. Create 4 buckets (one per quarter of the range)
2. Scatter: `0.08` and `0.11` → bucket 0; `0.42` → bucket 1; `0.75` → bucket 2
3. Sort each bucket (insertion sort is fine when buckets are small)
4. Concatenate buckets → `[0.08, 0.11, 0.42, 0.75]`

## How

1. Choose bucket count and a hash/range rule
2. Scatter each element
3. Sort locally
4. Stitch

Average **O(n)** when data is uniform enough that buckets stay small; worst **O(n²)** if everything lands in one bucket and you use a quadratic local sort.

## Trap

Assuming bucket sort is always linear regardless of distribution.

**Fix:** State the uniformity assumption — or fall back to an O(n log n) sort inside buckets.

**Time:** average O(n) under uniformity · **Space:** O(n + buckets)

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
