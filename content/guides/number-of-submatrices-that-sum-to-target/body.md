## Reduce to Subarray Sum Equals K

For each `top`: set `col = [0] · n`. For each `bottom ≥ top`:

1. Add row `bottom` into `col`.
2. Count subarrays of `col` summing to `target`: `seen = {0: 1}`, `run = 0`; for each `x`, `run += x`, `ans += seen.get(run − target, 0)`, `seen[run] += 1`.

Return `ans`.

Put the smaller dimension in the outer pair of loops to get O(min(m,n)² · max(m,n)).

Do not enumerate all four corners; that is O(m²n²). Do not start `seen` empty; the `{0: 1}` entry counts subarrays that begin at column 0.

Time: O(m² · n)  
Space: O(n)

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
